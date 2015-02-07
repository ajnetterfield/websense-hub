<div class="modal fade" id="sensor_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title" id="myModalLabel">Sensor</h4>

      </div>
      <div class="modal-body">

        <label for="name">Name</label>
        <input id="name" name="name" type="text" class="form-control" value="" placeholder="e.g. Bedroom 1 in-wall sensor" required autofocus />

        <label for="id">ID</label>
        <input id="id" name="id" type="text" class="form-control" value="" placeholder="e.g. HOBO-174839454" required />

        <label for="location">Location</label>
        <select id="location" name="location" class="form-control" required>
          <option value=""></option>
          <option value="">Kalgoorlie</option>
          <option value="">Perth</option>
        </select>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Save Changes</button>
      </div>
    </div>
  </div>
</div>
