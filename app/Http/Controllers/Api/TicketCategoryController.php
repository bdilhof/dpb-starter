<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tickets\TicketCategory;

class TicketCategoryController extends Controller
{
    public function index()
    {
        return TicketCategory::categoryTree();
    }
}
