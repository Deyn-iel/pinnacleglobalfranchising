
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
                            @php
  $userDept = strtolower(Auth::user()->usertype);
@endphp

<select name="department" class="form-select" required>
  <option value="">Select department</option>

  <option value="it" {{ $userDept == 'it' ? 'disabled' : '' }}>
    IT Tech Support Department {{ $userDept == 'it' ? '(Your Department)' : '' }}
  </option>

  <option value="od" {{ $userDept == 'od' ? 'disabled' : '' }}>
    Franchising Department {{ $userDept == 'od' ? '(Your Department)' : '' }}
  </option>

  <option value="om" {{ $userDept == 'om' ? 'disabled' : '' }}>
    KI Operations Department {{ $userDept == 'om' ? '(Your Department)' : '' }}
  </option>

  <option value="admin-secretary" {{ $userDept == 'admin-secretary' ? 'disabled' : '' }}>
    Corp Admin Secretary {{ $userDept == 'admin-secretary' ? '(Your Department)' : '' }}
  </option>

  <option value="hr" {{ $userDept == 'hr' ? 'disabled' : '' }}>
    Human Resources Department {{ $userDept == 'hr' ? '(Your Department)' : '' }}
  </option>

  <option value="smm" {{ $userDept == 'smm' ? 'disabled' : '' }}>
    Marketing Department {{ $userDept == 'smm' ? '(Your Department)' : '' }}
  </option>

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