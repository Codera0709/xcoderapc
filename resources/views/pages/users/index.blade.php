<x-layout.layout>
    <x-slot name="title">Users - XCODERA</x-slot>

    <div class="space-y-6">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Users Management</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage your team members and their permissions</p>
            </div>
            <x-ui.button variant="primary" @click="$dispatch('open-modal', 'create-user-modal')">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add User
            </x-ui.button>
        </div>

        <!-- Filters & Search -->
        <x-ui.card>
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <x-utils.searchbar placeholder="Search users by name or email..." />
                </div>
                <x-form.select name="role" :options="['all' => 'All Roles', 'admin' => 'Admin', 'editor' => 'Editor', 'viewer' => 'Viewer']" />
                <x-form.select name="status" :options="['all' => 'All Status', 'active' => 'Active', 'inactive' => 'Inactive']" />
            </div>
        </x-ui.card>

        <!-- Users Table -->
        <x-ui.card>
            <x-data.table
                :headers="[
                    ['label' => 'User', 'sortable' => true],
                    ['label' => 'Role', 'sortable' => true],
                    ['label' => 'Status', 'sortable' => false],
                    ['label' => 'Joined', 'sortable' => true],
                    ['label' => 'Actions', 'sortable' => false],
                ]"
                :rows="$users->map(function($user) {
                    return [
                        '<div class=\'flex items-center gap-3\'><div class=\'w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-semibold\'>'.substr($user->name, 0, 1).'</div><div><p class=\'font-medium text-gray-900 dark:text-white\'>'.e($user->name).'</p><p class=\'text-sm text-gray-500 dark:text-gray-400\'>'.e($user->email).'</p></div></div>',
                        '<span class=\'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400\'>'.ucfirst(e($user->role ?? 'viewer')).'</span>',
                        '<span class=\'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400\'>Active</span>',
                        '<span class=\'text-sm text-gray-600 dark:text-gray-400\'>'.e($user->created_at->format(\'M d, Y\')).'</span>',
                        '<div class=\'flex gap-2\'><button @click="$dispatch(\'open-modal\', {name: \'edit-user-modal\', user: {id: '.$user->id.', name: \''.addslashes(e($user->name)).'\', email: \''.addslashes(e($user->email)).'\', role: \''.e($user->role ?? 'viewer').'\', first_name: \''.addslashes(e(explode(\' \', $user->name)[0] ?? \'\')).'\', last_name: \''.addslashes(e(implode(\' \', array_slice(explode(\' \', $user->name), 1)) ?? \'\')).'\'}})" class=\'text-blue-600 hover:text-blue-800 dark:text-blue-400 text-sm font-medium\'>Edit</button><button @click="$dispatch(\'open-modal\', {name: \'delete-user-modal\', user: {id: '.$user->id.', name: \''.addslashes(e($user->name)).'\'}})" class=\'text-red-600 hover:text-red-800 dark:text-red-400 text-sm font-medium\'>Delete</button></div>'
                    ];
                })->toArray()"
                :striped="true"
                :hover="true"
            >
                <x-slot name="footer">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-600 dark:text-gray-400">Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users</p>
                        <div class="flex gap-2">
                            @if ($users->onFirstPage())
                                <x-ui.button size="sm" variant="outline" disabled>Previous</x-ui.button>
                            @else
                                <x-ui.button size="sm" variant="outline" :href="$users->previousPageUrl()">Previous</x-ui.button>
                            @endif
                            
                            @if ($users->hasMorePages())
                                <x-ui.button size="sm" variant="outline" :href="$users->nextPageUrl()">Next</x-ui.button>
                            @else
                                <x-ui.button size="sm" variant="outline" disabled>Next</x-ui.button>
                            @endif
                        </div>
                    </div>
                </x-slot>
            </x-data.table>
        </x-ui.card>
    </div>

    <!-- Create User Modal -->
    <x-ui.modal name="create-user-modal" title="Add New User" size="lg">
        <form class="space-y-4" method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form.input name="first_name" label="First Name" placeholder="John" required :value="old('first_name')" />
                <x-form.input name="last_name" label="Last Name" placeholder="Doe" required :value="old('last_name')" />
            </div>
            <x-form.input name="email" type="email" label="Email Address" placeholder="john@example.com" required :value="old('email')" />
            <x-form.select name="role" label="Role" :options="['admin' => 'Admin', 'editor' => 'Editor', 'viewer' => 'Viewer']" placeholder="Select role" required :value="old('role')" />
            <x-form.input name="password" type="password" label="Password" placeholder="••••••••" required />
            <x-form.input name="password_confirmation" type="password" label="Confirm Password" placeholder="••••••••" required />

            <div class="flex justify-end gap-2 pt-4">
                <x-ui.button type="button" variant="secondary" @click="$dispatch('close-modal', 'create-user-modal')">
                    Cancel
                </x-ui.button>
                <x-ui.button type="submit" variant="primary">
                    Create User
                </x-ui.button>
            </div>
        </form>
    </x-ui.modal>

    <!-- Edit User Modal -->
    <x-ui.modal name="edit-user-modal" title="Edit User" size="lg">
        <form class="space-y-4" method="POST" action="" id="edit-user-form">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-form.input name="first_name" label="First Name" placeholder="John" required :value="old('first_name')" />
                <x-form.input name="last_name" label="Last Name" placeholder="Doe" required :value="old('last_name')" />
            </div>
            <x-form.input name="email" type="email" label="Email Address" placeholder="john@example.com" required :value="old('email')" />
            <x-form.select name="role" label="Role" :options="['admin' => 'Admin', 'editor' => 'Editor', 'viewer' => 'Viewer']" placeholder="Select role" required :value="old('role')" />
            
            <div class="flex justify-end gap-2 pt-4">
                <x-ui.button type="button" variant="secondary" @click="$dispatch('close-modal', 'edit-user-modal')">
                    Cancel
                </x-ui.button>
                <x-ui.button type="submit" variant="primary">
                    Update User
                </x-ui.button>
            </div>
        </form>
    </x-ui.modal>

    <!-- Delete User Modal -->
    <x-ui.modal name="delete-user-modal" title="Delete User" size="sm">
        <div class="space-y-4">
            <p class="text-gray-600 dark:text-gray-300">Are you sure you want to delete this user?</p>
            <p class="font-medium text-gray-900 dark:text-white" x-text="'User: ' + ($event?.detail?.user?.name || '')"></p>
            
            <div class="flex justify-end gap-2 pt-4">
                <x-ui.button type="button" variant="secondary" @click="$dispatch('close-modal', 'delete-user-modal')">
                    Cancel
                </x-ui.button>
                <form method="POST" action="" style="display: inline-block;" id="delete-user-form">
                    @csrf
                    @method('DELETE')
                    <x-ui.button type="submit" variant="danger">
                        Delete
                    </x-ui.button>
                </form>
            </div>
        </div>
    </x-ui.modal>

    <script>
        document.addEventListener('alpine:init', () => {
            // Listen for the open-modal event to dynamically update the edit form
            document.addEventListener('open-modal', (event) => {
                if (event.detail.name === 'edit-user-modal' && event.detail.user) {
                    const user = event.detail.user;
                    const form = document.getElementById('edit-user-form');
                    
                    // Set the action URL for updating
                    form.action = `/users/${user.id}`;
                    
                    // Set the form values
                    form.querySelector('input[name="first_name"]').value = user.first_name || '';
                    form.querySelector('input[name="last_name"]').value = user.last_name || '';
                    form.querySelector('input[name="email"]').value = user.email || '';
                    form.querySelector('select[name="role"]').value = user.role || 'viewer';
                }
                
                if (event.detail.name === 'delete-user-modal' && event.detail.user) {
                    const user = event.detail.user;
                    const form = document.getElementById('delete-user-form');
                    
                    // Set the action URL for deletion
                    form.action = `/users/${user.id}`;
                }
            });
        });
    </script>
</x-layout.layout>
