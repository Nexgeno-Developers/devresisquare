
<!-- property offer add Modal -->
<div class="modal fade" id="addOfferModal" tabindex="-1" aria-labelledby="addOfferModal-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addOfferModal-label">Add Offer</h5>
          <a type="button" class="btn-close" onclick="closeModel();" data-bs-dismiss="modal" aria-label="Close"></a>
        </div>
        <div class="modal-body">
            <!-- Main Form -->
            <form class="tenantOfferForm" id="tenantOfferForm">
                <!-- Steps Container -->
                <div id="steps-container">
                    <input type="hidden" id="mainPersonId" name="mainPersonId">
                    <!-- Tenant Forms -->
                    <div id="tenant-forms" class="step"></div>

                    <!-- Offer Details Step -->
                    <div id="offer-step" class="step hidden">
                        <h6>Offer Details</h6>
                        <div class="row">
                          <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter price" required>
                                </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="deposit" class="form-label">Deposit</label>
                                    <input type="number" class="form-control" id="deposit" name="deposit" placeholder="Enter deposit amount" required>
                                </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="term" class="form-label">Term</label>
                                    <input type="text" class="form-control" id="term" name="term" placeholder="Enter term" required>
                                </div>
                            </div>
                          </div>
                          <div class="col-lg-6 col-12">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="moveInDate" class="form-label">Move-in Date</label>
                                    <input type="date" class="form-control" id="moveInDate" name="moveInDate" required>
                                </div>
                            </div>
                          </div>
                        </div>
                        
                        
                        
                    </div>
                </div>
            </form>
            <span id="addTenantButton" class="add-tenant-btn hidden" onclick="addTenant()">Add More Tenant</span>
        </div>
        <!-- Modal Footer Navigation -->
        <div class="modal-footer">
            <button type="button" class="btn btn_outline_secondary btn-sm" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            <button id="backButton" type="button" class="btn btn_secondary btn-md hidden">Back</button>
            <button id="nextButton" type="button" class="btn btn_secondary btn-md ">Next</button>
            <button id="submitButton" type="submit" form="tenantOfferForm" class="btn btn_secondary btn-md hidden">Submit</button>
        </div>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="largeModal" tabindex="-1" aria-labelledby="largeModal-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="largeModal-label">Loading...</h5>
        <a type="button" class="btn-close" onclick="closeModel();" data-bs-dismiss="modal" aria-label="Close"></a>
      </div>
      <div class="modal-body">
        Loading...
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="smallModal" tabindex="-1" aria-labelledby="smallModal-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="smallModal-label">Loading...</h5>
        <a type="button" class="btn-close" onclick="closeModel();" data-bs-dismiss="modal" aria-label="Close"></a>
      </div>
      <div class="modal-body">
        Loading...
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModal-label" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body text-center">
        <form method="POST" class="ajaxDeleteForm" action="" id ="delete_form">
          @csrf
          <i class="fa-solid fa-circle-info" style="font-size: 50px;color: #dc3545;"></i>
          <p class="mt-3">Are you sure?</p>
          <button type="button" class="btn btn-sm btn-info" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i> Cancel</button>
          <button type="submit" class="btn btn-sm btn-secondary" onclick=""><i class="fa-solid fa-arrow-right-from-bracket"></i> Continue</button>
        </form>
      </div>
    </div>
  </div>
</div>
