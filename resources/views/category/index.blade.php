<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Create Button -->
            <button class="btn btn-sm btn-primary" onclick="create_category.showModal()">Create</button>

            <!-- Create Category Modal -->
            <dialog id="create_category" class="modal">
                <div class="modal-box">
                    <h3 class="text-lg font-bold">Create Category</h3>
                    <!-- Form to create a new category -->
                    <form action="{{route('category.store')}}" method="POST">
                        @csrf <!-- Add CSRF token if needed for Laravel -->
                        <div class="mb-4">
                            <input type="text" id="category_name" name="name" required
                                class="input input-bordered w-full mt-1" placeholder="Enter category name">
                        </div>

                        <!-- Modal action buttons -->
                        <div class="modal-action">
                            <!-- Submit button for the form -->
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            <!-- Cancel button to close the modal -->
                            <button type="button" class="btn btn-sm btn-secondary" onclick="create_category.close()">Cancel</button>
                        </div>
                    </form>
                </div>
            </dialog>

            <!-- Categories Table -->
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $index => $category)
                            <tr>
                                <th>{{ $index + 1 }}</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-warning" onclick="document.getElementById('edit_category_{{$category->id}}').showModal()">Edit</button>
                                    
                                    <!-- Delete Button -->
                                    <button class="btn btn-sm btn-error" onclick="document.getElementById('delete_category_{{$category->id}}').showModal()">Delete</button>
                                </td>
                            </tr>

                            <!-- Edit Category Modal -->
                            <dialog id="edit_category_{{$category->id}}" class="modal">
                                <div class="modal-box">
                                    <h3 class="text-lg font-bold">Edit Category</h3>
                                    <!-- Form to edit the category -->
                                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                                        @csrf
                                        @method('PUT') <!-- Add PUT method for updating -->
                                        <div class="mb-4">
                                            <input type="text" name="name" value="{{ $category->name }}" required
                                                class="input input-bordered w-full mt-1" placeholder="Enter category name">
                                        </div>

                                        <div class="modal-action">
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                            <button type="button" class="btn btn-sm btn-secondary" onclick="document.getElementById('edit_category_{{$category->id}}').close()">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </dialog>

                            <!-- Delete Confirmation Modal -->
                            <dialog id="delete_category_{{$category->id}}" class="modal">
                                <div class="modal-box">
                                    <h3 class="text-lg font-bold">Delete Category</h3>
                                    <p>Are you sure you want to delete the category "{{ $category->name }}"?</p>
                                    <div class="modal-action">
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE') <!-- Add DELETE method for removing -->
                                            <button type="submit" class="btn btn-sm btn-error">Delete</button>
                                        </form>
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="document.getElementById('delete_category_{{$category->id}}').close()">Cancel</button>
                                    </div>
                                </div>
                            </dialog>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
