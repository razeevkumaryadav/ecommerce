<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Add New Coupon</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="coupon_add.php">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Code</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">min Volume</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="minvol" name="minvol" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">max Volume</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="maxvol" name="maxvol" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Discount</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="discount" name="discount" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Edit Coupon</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="coupon_edit.php">
                <input type="hidden" class="catid" name="id">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Code</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_code" name="code" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">min Volume</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_minvol" name="minvol" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">max Volume</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_maxvol" name="maxvol" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Discount</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_discount" name="discount" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="coupon_delete.php">
                <input type="hidden" class="catid" name="id">
                <div class="text-center">
                    <p>DELETE COUPON</p>
                    <h2 class="bold catname"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>
