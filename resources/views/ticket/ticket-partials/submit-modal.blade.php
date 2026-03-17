
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
    <select name="branch" class="form-select" required>
        <option value="" disabled selected>Select branch</option>

        <option value="Cauayan" {{ old('branch') == 'Cauayan' ? 'selected' : '' }}>KI Cauayan Branch</option>
        <option value="Ilagan" {{ old('branch') == 'Ilagan' ? 'selected' : '' }}>KI Ilagan Branch</option>
        <option value="San Mateo" {{ old('branch') == 'San Mateo' ? 'selected' : '' }}>KI San Mateo Branch</option>
        <option value="Ramon" {{ old('branch') == 'Ramon' ? 'selected' : '' }}>KI Ramon Branch</option>
        <option value="Capas" {{ old('branch') == 'Capas' ? 'selected' : '' }}>KI Capas Branch</option>
        <option value="Aurora" {{ old('branch') == 'Aurora' ? 'selected' : '' }}>KI Aurora Branch</option>
        <option value="Roxas" {{ old('branch') == 'Roxas' ? 'selected' : '' }}>KI Roxas Branch</option>
        <option value="Cabagan" {{ old('branch') == 'Cabagan' ? 'selected' : '' }}>KI Cabagan Branch</option>
        <option value="Tumauini" {{ old('branch') == 'Tumauini' ? 'selected' : '' }}>KI Tumauini Branch</option>
        <option value="SMDC" {{ old('branch') == 'SMDC' ? 'selected' : '' }}>KI SMDC Branch</option>
        <option value="Food Truck" {{ old('branch') == 'Food Truck' ? 'selected' : '' }}>KI Food Truck</option>
    </select>
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

                        <!-- DEPARTMENT -->
                        <div class="mb-3">
                            <label class="form-label">Department</label>
                            <select name="department" class="form-select" required>
                                <option value="">Select department</option>
                                <option value="it">IT</option>
                                <option value="operations">Operations</option>
                                <option value="admin">Admin</option>
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
                                    class="btn btn-dark btn-sm p-2 fw-semibold" 
                                    style="border-radius: 15px;"
                                    data-bs-dismiss="modal"> Cancel
                            </button>

                            <button type="submit" class="btn btn-dark btn-sm p-2 fw-semibold" style="border-radius: 15px;">
                                <i class="bi bi-send"></i> Submit
                            </button>
                        </div>

                    </form>

            </div>
        </div>
    </div>
</div>