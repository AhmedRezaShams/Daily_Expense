<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Create Button -->
            <button class="btn btn-sm btn-primary" onclick="create_expense.showModal()">Create</button>

            <!-- Create Expense Modal -->
            <dialog id="create_expense" class="modal">
                <div class="modal-box">
                    <h3 class="text-lg font-bold">Add Expense</h3>
                    <!-- Form to create a new expense -->
                    <form action="{{route('expense.store')}}" method="POST" id="expense-form">
                        @csrf <!-- Add CSRF token if needed for Laravel -->

                        <!-- Date Input with type="date" -->
                        <div class="mb-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" id="date" name="date" class="input input-bordered w-full mt-1" required>
                        </div>

                        <!-- Dynamic Inputs for Transactions -->
                        <div id="transaction-container">
                            <div class="transaction-item mb-4">
                                <!-- Transaction Type (Radio Buttons) -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Transaction Type</label>
                                    <div class="mt-2">
                                        <input type="radio" name="transaction_type[]" value="debit" id="debit" required> In
                                        <input type="radio" name="transaction_type[]" value="credit" id="credit" required> Out
                                    </div>
                                </div>

                                <!-- Category Select Dropdown -->
                                <div class="mt-4">
                                    <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                    <select name="category[]" class="input input-bordered w-full mt-1" required>
                                        @foreach($categories as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Reason Input -->
                                <div class="mt-4">
                                    <label for="reason" class="block text-sm font-medium text-gray-700">Reason</label>
                                    <input type="text" name="reason[]" class="input input-bordered w-full mt-1" placeholder="Enter reason" required>
                                </div>

                                <!-- Amount Input -->
                                <div class="mt-4">
                                    <label for="amount" class="block text-sm font-medium text-gray-700">Amount</label>
                                    <input type="number" step="0.01" name="amount[]" class="input input-bordered w-full mt-1" placeholder="Enter amount" required>
                                </div>
                            </div>
                        </div>

                        <!-- Add More Button -->
                        <button type="button" class="btn btn-sm btn-neutral mt-4" id="add-more">Add More</button>

                        <!-- Modal action buttons -->
                        <div class="modal-action">
                            <!-- Submit button for the form -->
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            <!-- Cancel button to close the modal -->
                            <button type="button" class="btn btn-sm btn-secondary" onclick="create_expense.close()">Cancel</button>
                        </div>
                    </form>
                </div>
            </dialog>

        </div>
    </div>
</x-app-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Set today's date as default in the date input
        const today = new Date().toISOString().split('T')[0]; // Gets YYYY-MM-DD format
        document.getElementById('date').value = today;

        // Function to add more dynamic input fields
        document.getElementById('add-more').addEventListener('click', function() {
            var transactionContainer = document.getElementById('transaction-container');
            var newTransaction = document.querySelector('.transaction-item').cloneNode(true);
            transactionContainer.appendChild(newTransaction);
        });
    });
</script>
