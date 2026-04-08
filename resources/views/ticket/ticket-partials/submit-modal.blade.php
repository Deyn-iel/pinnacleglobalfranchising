
<div class="modal fade" id="submitTicketModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-body p-4">

                <div class="form-header mb-3">
                    <h5 class="mb-0 fw-semibold"><i class="bi bi-life-preserver"></i> Submit a Support Concern</h5>
                </div>

                <form id="ticketForm" method="POST" action="{{ route('tickets.store') }}">
                        @csrf

<div class="mb-3">
  <label class="form-label">Branch</label>

  <input 
    type="text" 
    class="form-control" 
    value="{{ ucwords(strtolower(Auth::user()->name)) }}" 
    style="background-color: transparent;"
    disabled
  >

  <input 
    type="hidden" 
    name="branch" 
    value="{{ ucwords(strtolower(Auth::user()->name)) }}"
  >
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

                        {{-- <div class="divider"></div> --}}

                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="department" class="form-select" required>
                                <option value="">Select department</option>
                                <option value="it">IT</option>
                                <option value="od">Operations Director</option>
                                <option value="om">Operations Manager</option>
                                <option value="admin-secretary">Admin</option>
                                <option value="hr">HR</option>
                                <option value="smm">SMM</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Priority Level</label>
                            <select name="priority" class="form-select" required>
                                <option value="">Select priority</option>
                                <option value="low">Low – Not urgent</option>
                                <option value="medium">Medium – Needs attention</option>
                                <option value="high">High – Urgent</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button"
                                    class="btn btn-dark btn-sm p-2 fw-semibold" 
                                    style="border-radius: 15px;"
                                    data-bs-dismiss="modal"> Cancel
                            </button>

                            <button id="submitBtn" type="submit" class="btn btn-dark btn-sm p-2 fw-semibold" style="border-radius: 15px;">
                                <i class="bi bi-send"></i> Submit
                            </button>
                        </div>

                        
                    </form>

            </div>
        </div>
    </div>
</div>