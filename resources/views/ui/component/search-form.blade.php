<form class="search-form p-lg-0">
  <div class="form-row">
    <div class="form-group col-lg-4 mb-1 mb-lg-0 p-lg-0 treatment-group">
      <label for="treatment" class="sr-only">Select a treatment (if known)</label>
      <select name="treatment" class="custom-select mb-0">
        <option selected disabled>Select a treatment (if known)</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
    </div>
    <div class="form-group col-lg-4 mb-1 mb-lg-0 p-lg-0 postcode-group">
      <label class="sr-only" for="postcode">Enter Postcode</label>
      <input type="text" name="postcode" class="form-control mb-0 mr-sm-2" id="postcode" placeholder="Enter Postcode">
    </div>
    <div class="form-group col-lg-4 mb-1 mb-lg-0 p-lg-0 d-none distance-group">
      <label for="distance" class="sr-only">Distance</label>
      <select name="distance" class="custom-select mb-0">
        <option selected disabled>Distance</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
    </div>
    <div class="form-group col-lg-4 mb-1 mb-lg-0 p-lg-0 submit-group">
      <button type="submit" class="btn btn-block bg-brandColor1 text-white mb-0">Search</button>
    </div>
  </div>
</form>