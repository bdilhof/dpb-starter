<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tickets\TicketCategory;

class TicketCategoryController extends Controller
{
    public function index()
    {
        $categories = TicketCategory::query()
            ->select("id", "title", "created_at")
            ->with("subCategories:id,title,ticket_category_id")
            ->whereNull("ticket_category_id")
            ->get();

        return view("admin.categories.index", [
            "title" => trans('admin.categories'),
            "categories" => $categories,
        ]);
    }

    public function create()
    {
        return view("admin.categories.create", [
            "title" => trans("ui.new_entry"),
            "showBackButton" => true,
        ]);
    }

    public function store()
    {
        request()->validate([
            "title" => "required",
        ]);

        $category = TicketCategory::create([
            "title" => request()->input("title"),
            "ticket_category_id" => request()->input("ticket_category_id"),
        ]);

        return redirect()
            ->route("admin.categories.index")
            ->with("status-success", "OK");
    }
}
