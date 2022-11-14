<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id='modalPTitle'>Product Name</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img id="modalPImage" class="card-img-top" src="" alt="Card image cap"
                                    style="height: 235px;width:235px;">

                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item">Price: <span id="modalPPrice"></span></li>
                                <li class="list-group-item">Product Code: <span id="modalPCode"></span></li>
                                <li class="list-group-item">Category: <span id="modalPCategory"></span></li>
                                <li class="list-group-item">Brand: <span id="modalPBrand"></span></li>
                                <li class="list-group-item">Stock: <span id="modalPStock"
                                        class="badge badge-pill"></span></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Choose Color</label>
                                <select class="form-control" id="modalPColor">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4" id="modalPSizeSection">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Choose Size</label>
                                <select class="form-control" id="modalPSize">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Quantity</label>
                                <input type="number" class="form-control" id="modalPQty" placeholder="name@example.com"
                                    value="1" min="1">
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary mb-2" style="margin-left: 15px;">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
