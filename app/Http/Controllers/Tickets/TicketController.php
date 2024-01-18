<?php

namespace App\Http\Controllers\Tickets;

use App\Models\Tickets\TicketEntry;
use App\Services\TicketService\CreateTicketService;
use App\Http\Controllers\Controller;
use App\Services\TicketService\UpdateTicketService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input("filter");

        $tickets = TicketEntry::query()
            ->select("id", "title", "created_at", "status", "priority", "ticket_category_id", "reported_via")
            ->orderByRaw("CASE WHEN priority = 'HIGH' THEN 1 WHEN priority = 'NORMAL' THEN 2 ELSE 3 END")
            ->orderByDesc("created_at");

        if ($title = data_get($filter, "title")) {
            $tickets->where("title", "LIKE", "%$title%");
        }

        if ($category = data_get($filter, "ticket_category_id")) {
            $tickets->where("ticket_category_id", $category);
        }

        if ($status = data_get($filter, "status")) {
            $tickets->where("status", $status);
        }

        if ($assignedTo = data_get($filter, "assigned_to")) {
            $tickets->whereHas("users", function ($query) use ($assignedTo) {
                $query->where("users.id", $assignedTo);
            });
        }

        if ($dateFrom = data_get($filter, "date_from")) {
            $tickets->where("created_at", ">=", $dateFrom);
        }

        if ($dateTo = data_get($filter, "date_to")) {
            $tickets->where("created_at", ">=", $dateTo);
        }

        return view("tickets.index", [
            "title" => "Všetky tickety",
            "filter" => $filter,
            "tickets" => $tickets->paginate(),
        ]);
    }

    public function user(Request $request)
    {
        $tickets = auth()->user()->tickets();
        $filter = $request->input("filter");

        return view("tickets.user", [
            "title" => __('ticket.assigned_to_user'),
            "tickets" => $tickets->paginate(),
            "filter" => $filter,
        ]);
    }

    public function unassigned(Request $request)
    {
        $tickets = TicketEntry::query()
            ->select('id', 'title', 'created_at', 'status', 'priority', 'ticket_category_id')
            ->whereNotIn('id', function ($query) {
                $query->select('ticket_entry_id')->from('ticket_entries_users');
            });

        $filter = $request->input("filter");

        return view("tickets.unassigned", [
            "title" => __('ticket.unassigned_tickets'),
            "tickets" => $tickets->paginate(),
            "filter" => $filter,
        ]);
    }

    public function create()
    {
        $ticket = TicketEntry::make();

        return view("tickets.create", [
            "title" => trans("ui.new_entry"),
            "ticket" => $ticket,
            "backUrl" => route("tickets.index"),
            "showBackButton" => true,
        ]);
    }

    public function store(CreateTicketService $createTicketService, StoreTicketRequest $request)
    {
        $newTicket = $createTicketService->createNewTicket([
            "title" => $request->input('title'),
            "ticket_category_id" => $request->input('ticket_category_id'),
            "description" => $request->input('description'),
            "priority" => $request->input("priority", "normal"),
            "ticket_entry_id" => $request->input("ticket_entry_id"),
        ]);

        if ($request->has('assigned_to')) {
            $newTicket->users()->attach($request->input('assigned_to'));
        }

        return redirect()
            ->route('tickets.show', ["ticket" => $newTicket->id])
            ->with("status-success", "Ticket #$newTicket->id bol úspešne vytvorený");
    }

    public function show(TicketEntry $ticket)
    {
        $ticket->load('category', 'childTickets');

        return view("tickets.show", [
            "title" => $ticket->titleFormatted,
            "ticket" => $ticket,
            "backUrl" => route("tickets.index"),
            "showBackButton" => true,
        ]);
    }

    public function edit(TicketEntry $ticket)
    {
        return view("tickets.edit", [
            "title" => trans("ui.edit"),
            "backUrl" => route("tickets.index"),
            "showBackButton" => true,
            "ticket" => $ticket,
        ]);
    }

    public function update(TicketEntry $ticket, UpdateTicketService $service, UpdateTicketRequest $request)
    {
        $service->updateTicket($ticket, $request->input('ticket'));

        return redirect()
            ->route("tickets.show", ["ticket" => $ticket->id])
            ->with("status-success", "Ticket #$ticket->id bol úspešne upravený");
    }

    public function comment(Request $request, TicketEntry $ticket)
    {
        $comment = $request->input('comment');
        $comment['user_id'] = auth()->id();

        $ticket->comments()->create($comment);

        return redirect()->back();
    }

    public function status(Request $request, TicketEntry $ticket)
    {
        $ticket->status = $request->input('ticket.status');
        $ticket->save();

        return redirect()
            ->route("tickets.show", $ticket->id)
            ->with("status-success", "status has been changed");

    }

    public function members(Request $request, TicketEntry $ticket)
    {
        $users = $request->input('users');
        $ticket->users()->sync($users, ["role" => 1]);

        return redirect()->route("tickets.show", ["ticket" => $ticket->id])->with("status-success", "OK");
    }

    public function destroy(TicketEntry $ticket)
    {
        $id = $ticket->id;

        $ticket->delete();

        return redirect()
            ->route('tickets.index')
            ->with("status-success", "Ticket with ID #{$id} has been deleted");
    }
}
