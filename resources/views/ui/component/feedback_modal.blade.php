<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <form>

          <h5 id="feedbackModalLabel">Thanks for visiting Hospital Compare.</h5>
          <p>Before leaving can you spare a moment to tell us what you thought?</p>
          <div class="form-group">
            @include('ui.component.rating_input')
          </div>
          <div class="form-group">
            <textarea class="form-control mx-auto" placeholder="Any further feedback?" name="feedback" id="feedback" cols="30"
              rows="4"></textarea>
          </div>
          <button type="button" class="btn btn-brandRounded bg-brandColor1 text-white">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>