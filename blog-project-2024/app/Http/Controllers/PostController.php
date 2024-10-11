<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Database\QueryException;
use Intervention\Image\Drivers\Gd\Driver;

/**
 * PostController
 *
 * Author: Abdullah Shah
 *
 * This controller handles CRUD operations for the Post model, including image upload and resizing,
 * category assignment, and post status toggling. Intervention Image is used to manage image resizing.
 */
class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $post = new Post();
        $allPosts = Post::orderBy('post_name')->get();
        $allCategories = Category::where('status', 1)->orderBy('category_name')->get();
        return view('backend.post.index', compact('post', 'allPosts', 'allCategories'));
    }



    public function store(Request $request)
    {
        $data = $this->validatePost();

        try {
            DB::beginTransaction();

            // Generate the slug and set the status
            $data['post_slug'] = Str::slug($request->post_name);
            $data['status'] = $request->publish_at ? 0 : 1;

            // Handle the file upload and image resizing
            if ($request->hasFile('feature_image')) {

                $file = $request->feature_image;
                $fileName = time() . '.' . $file->extension();

                $path = 'backend/image/' . $fileName;
                $manager = new ImageManager(new Driver());
                $image = $manager->read($file);
                $image = $image->resize(150, 150);
                $image->toJpeg(80)->save($path);
                // $imageName = 'backend/image/' . $fileName;
                $data['feature_image'] = $fileName;
            }


            // Format publish_at for MySQL DATETIME format if provided
            if ($request->publish_at) {
                $data['publish_at'] = Carbon::parse($request->publish_at)->format('Y-m-d H:i:s');
            }

            // Create the post and attach categories
            $post = Post::create($data);
            $post->categories()->attach($request->category);

            DB::commit();

            // // Queue the job with the delayed execution if publish_at is set
            // if ($post->publish_at) {
            //     PublishPostJob::dispatch($post->id)->delay(new Carbon($post->publish_at));
            // }

            return redirect()->route('post.index')->with('success', 'Post created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while creating the post.')->withInput();
        }
    }





    /**
     * Show the form for editing the specified post.
     *
     * @param Post $post
     * @return \Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $allCategories = Category::orderBy('category_name')->get();
        return view('backend.post.edit', compact('post', 'allCategories'));
    }

    /**
     * Update the specified post in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request)
    {
        $data = $this->validateUpdatePost();

        try {
            DB::beginTransaction();

            // Generate the slug from the post name
            $data['post_slug'] = Str::slug($request->post_name);
            $data['status'] = $request->publish_at ? 0 : 1;

            // Format publish_at for MySQL DATETIME format if provided
            if ($request->publish_at) {
                $data['publish_at'] = Carbon::parse($request->publish_at)->format('Y-m-d H:i:s');
            }
            $post = Post::find($request->hidden_id);


            // Handle the file upload and image resizing
            if ($request->hasFile('feature_image')) {
                // Get the old image path
                $imagePath = 'backend/image/' . $post->feature_image;

                $file = $request->feature_image;
                $fileName = time() . '.' . $file->extension();
                $path = 'backend/image/' . $fileName;

                $manager = new ImageManager(new Driver());
                $image = $manager->read($file);
                $image = $image->resize(150, 150);
                $image->toJpeg(80)->save($path);

                // Assign the new file name to the data array
                $data['feature_image'] = $fileName;

                // Unlink the old image if it exists
                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                }
            }

            // Set the post_feature field (default to false if not checked)
            $data['post_feature'] = $request->has('post_feature') ? true : false;

            // Update the post using the validated data
            $post->update($data);

            // Sync the selected categories
            $post->categories()->sync($request->category);

            DB::commit();
            // // Queue the job with the delayed execution if publish_at is set
            if ($post->publish_at) {
                PublishPostJob::dispatch($post->id)->delay(new Carbon($post->publish_at));
            }

            // Redirect back with a success message
            return redirect()->route('post.index')->with('success', 'Post updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            // Handle exception
            return redirect()->back()->with('error', 'An error occurred while updating the post.')->withInput();
        }
    }


    /**
     * Remove the specified post from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // Find the post by ID
            $post = Post::findOrFail($id);

            // Get the image path and delete the associated image
            $imagePath = 'backend/image/' . $post->feature_image;
            if (file_exists($imagePath)) {
                @unlink($imagePath);
            }

            $post->delete();

            DB::commit();
            return redirect()->route('post.index')->with('success', 'Post deleted successfully.');
        } catch (QueryException $ex) {
            DB::rollBack();
            return redirect()->route('post.index')->with('error', 'Error deleting Post.');
        }
    }


    /**
     * Toggle the status of the post (active/inactive).
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function status($id)
    {
        try {
            DB::beginTransaction();

            // Find the post by ID
            $post = Post::findOrFail($id);

            // Toggle the status
            $post->status = $post->status == 1 ? 0 : 1;

            // Save the updated status
            $post->save();

            DB::commit();

            // Return a JSON response for AJAX
            return response()->json([
                'status' => $post->status,
                'message' => 'Post status updated successfully.'
            ]);
        } catch (QueryException $ex) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error updating post status.'
            ], 500);
        }
    }

    /**
     * Validate the post input data for creating a new post.
     *
     * @return array
     */
    private function validatePost()
    {
        return request()->validate([
            'post_code' => 'required|string|max:255',
            'post_name' => 'required|string|max:255|min:3',
            'post_summary' => 'required|string',
            'post_details' => 'required|string',
            'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'post_feature' => 'nullable|boolean',
            'publish_at' => 'nullable|date', // validation for publish_at
        ]);
    }

    /**
     * Validate the post input data for updating an existing post.
     *
     * @return array
     */
    private function validateUpdatePost()
    {
        return request()->validate([
            'post_code' => 'required|string|max:255',
            'post_name' => 'required|string|max:255',
            'post_summary' => 'required|string',
            'post_details' => 'required|string',
            'feature_image' => 'image|mimes:jpeg,png,jpg,gif',
            'post_feature' => 'nullable|boolean',
            'publish_at' => 'nullable|date', // validation for publish_at

        ]);
    }
}
