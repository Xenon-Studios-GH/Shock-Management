<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\WorkLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class WorkerController extends Controller
{
    protected WorkLogService $workLogService;

    public function __construct(WorkLogService $workLogService)
    {
        $this->workLogService = $workLogService;
    }

    public function index()
    {
        $workers = User::where('role', 'staff')->latest()->paginate(20);
        return view('workers.index', compact('workers'));
    }

    public function create()
    {
        return view('workers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'staff';
        $validated['status'] = true;

        $user = User::create($validated);

        $this->workLogService->log(
            'User Created',
            'user',
            $user->id,
            "Worker {$user->name} ({$user->email}) was created"
        );

        return redirect()->route('workers.index')
            ->with('success', 'Worker created successfully.')
            ->with('created_password', $request->password);
    }

    public function edit(User $worker)
    {
        if ($worker->role !== 'staff') {
            abort(404);
        }
        return view('workers.edit', compact('worker'));
    }

    public function update(Request $request, User $worker)
    {
        if ($worker->role !== 'staff') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($worker->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $worker->update($validated);

        $this->workLogService->log(
            'User Updated',
            'user',
            $worker->id,
            "Worker {$worker->name} ({$worker->email}) was updated"
        );

        return redirect()->route('workers.index')->with('success', 'Worker updated successfully.');
    }

    public function toggleStatus(User $worker)
    {
        if ($worker->role !== 'staff') {
            abort(404);
        }

        $worker->update(['status' => !$worker->status]);

        $action = $worker->status ? 'activated' : 'deactivated';
        $this->workLogService->log(
            'User Updated',
            'user',
            $worker->id,
            "Worker {$worker->name} ({$worker->email}) was {$action}"
        );

        return redirect()->route('workers.index')->with('success', "Worker {$action} successfully.");
    }
}
