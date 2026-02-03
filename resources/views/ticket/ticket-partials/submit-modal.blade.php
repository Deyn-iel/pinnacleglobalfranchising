<!-- =========================
     SUBMIT TICKET MODAL
========================= -->
<div class="modal fade" id="submitTicketModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-body p-4">

                <div class="form-header mb-3">
                    <h5 class="mb-0 fw-semibold"><i class="bi bi-life-preserver"></i> Submit a Support Concern</h5>
                </div>

                <form method="POST" action="{{ route('tickets.store') }}">
                        @csrf

                        <!-- SUBJECT -->
                        <div class="mb-3">
                            <label class="form-label">Branch</label>
                            <input type="text"
                                   name="subject"
                                   class="form-control"
                                   placeholder="Enter the branch name"
                                   value="{{ old('subject') }}"
                                   required>
                        </div>

                        <!-- DESCRIPTION -->
                        <div class="mb-3">
                            <label class="form-label">Concern Details</label>
                            <textarea name="description"
                                      rows="4"
                                      class="form-control"
                                      placeholder="Explain your concern in detail"
                                      required>{{ old('description') }}</textarea>
                        </div>

                        <div class="divider"></div>

                        <!-- DEPARTMENT -->
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="department" class="form-select" required>
                                <option value="">Select department</option>
                                <option value="it">IT</option>
                                <option value="operations">Operations</option>
                                <option value="finance">Admin</option>
                                <option value="hr">HR</option>
                                <option value="smm">SMM</option>
                            </select>
                        </div>

                        <!-- PRIORITY -->
                        <div class="mb-4">
                            <label class="form-label">Priority Level</label>
                            <select name="priority" class="form-select" required>
                                <option value="">Select priority</option>
                                <option value="low">Low – Not urgent</option>
                                <option value="medium">Medium – Needs attention</option>
                                <option value="high">High – Urgent</option>
                            </select>
                        </div>

                        <!-- ACTIONS -->
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button"
                                    class="btn btn-primary btn-sm p-2"
                                    data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i> Cancel
                            </button>

                            <button type="submit" class="btn btn-primary btn-sm p-2">
                                <i class="bi bi-send"></i> Submit
                            </button>
                        </div>

                    </form>

            </div>
        </div>
    </div>
</div>