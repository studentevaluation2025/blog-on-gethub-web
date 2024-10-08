<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index($timePeriod = 'total') {
        $categoryCount = Category::where('status', 1)->count();
        $postCount = $this->getPostCountByPeriod($timePeriod);
        return view('backend/dashboard', compact('postCount', 'timePeriod', 'categoryCount'));
    }

    // Handle post counts dynamically
    private function getPostCountByPeriod($timePeriod)
    {
        $query = Post::where('status', 1);

        switch ($timePeriod) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'month':
                $query->whereMonth('created_at', Carbon::now()->month);
                break;
            case 'year':
                $query->whereYear('created_at', Carbon::now()->year);
                break;
            default:
                // 'total' or any other case
                break;
        }

        return $query->count();
    }

    // Redirect to the appropriate method based on time period
    public function posts($timePeriod)
    {
        return $this->index($timePeriod);
    }

}
