<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class PostController extends Controller
{
    public function index() {
        $post = new Post();
        $allPosts = Post::orderBy('post_name')->get();
        return view('backend.post.index', compact('post', 'allPosts'));
    }

    public function store(Request $request) {
        $data = $this->validatePost();

        try {
            DB::beginTransaction();

             // Generate the slug from the post name
             $data['post_slug'] = Str::slug($request->post_name);

            // Handle the file upload
            if ($request->hasFile('feature_image')) {
                $image = $request->feature_image;
                $ext = $image->getClientOriginalExtension();
                $imageName = time().'.'.$ext;
                $image->move(public_path('backend/image'), $imageName);
                $data['feature_image'] = $imageName;
            }
            // Set the post_feature field (default to false if not checked)
            $data['post_feature'] = $request->has('post_feature') ? true : false;

            // Create a new post using the validated data
            Post::create($data);

            DB::commit();

            // Redirect back with a success message
            return redirect()->route('post.index')->with('success', 'Post created successfully!');

        } catch(\Exception $e) {
            DB::rollBack();

            // Redirect back with an error message if something goes wrong
            return redirect()->back()->with('error', 'An error occurred while creating the post.')->withInput();
        }

    }

    public function edit(Post $post) {
         return view('backend.post.edit', compact('post'));
    }

    public function update(Request $request) {
        $data = $this->validatePost();
        try {
            DB::beginTransaction();

             // Generate the slug from the post name
             $data['post_slug'] = Str::slug($request->post_name);
             $post = Post::find($request->hidden_id);
            // Handle the file upload
            if ($request->hasFile('feature_image')) {
                // Get the old image path
                $oldImagePath = public_path('backend/image/' . $post->feature_image);

                // Process the new image
                $image = $request->file('feature_image');
                $ext = $image->getClientOriginalExtension();
                $imageName = time().'.'.$ext;
                $image->move(public_path('backend/image'), $imageName);

                // Assign the new image name to the data array
                $data['feature_image'] = $imageName;

                // Unlink the old image if it exists
                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath); // Use '@' to suppress errors if file doesn't exist
                }
            }
            // Set the post_feature field (default to false if not checked)
            $data['post_feature'] = $request->has('post_feature') ? true : false;

            // Create a new post using the validated data
            Post::find($request->hidden_id)->update($data);

            DB::commit();

            // Redirect back with a success message
            return redirect()->route('post.index')->with('success', 'Post updated successfully!');

        } catch(\Exception $e) {
            DB::rollBack();

            // Redirect back with an error message if something goes wrong
            return redirect()->back()->with('error', 'An error occurred while updating the post.')->withInput();
        }

    }

    public function destroy($id) {
        try {
            DB::beginTransaction();
            // Find the post by ID
            $post = Post::findOrFail($id);

            // Get the image path
            $imagePath = public_path('backend/image/' . $post->feature_image);

            // Unlink the image if it exists
            if (file_exists($imagePath)) {
            @unlink($imagePath); // Use '@' to suppress errors if file doesn't exist
        }

            $post->delete();

            DB::commit();
            return redirect()->route('post.index')->with('success', 'Post deleted successfully.');
        } catch (QueryException $ex) {
            DB::rollBack();
            return redirect()->route('post.index')->with('error', 'Error deleting Post.');
        }
    }

    public function status($id) {
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

    private function validatePost() {
        return request()->validate([
            'post_code' => 'required|string|max:255',
            'post_name' => 'required|string|max:255',
            'post_summary' => 'required|string',
            'post_details' => 'required|string',
            // 'feature_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            // 'status' => 'required|in:active,inactive',
            'post_feature' => 'nullable|boolean',
        ]);
    }
}
