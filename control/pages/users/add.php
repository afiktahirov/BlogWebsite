<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h5 class="mb-0">Məhsul Formu</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Məhsulun Adı:</label>
                            <input type="text" name="name" class="form-control border">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Məhsulun Kategoriyası:</label>
                            <select name="category" class="form-select border">
                                      <option value="">a</option>
                                      <option value="">b</option>
                                      <option value="">c</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Məhsulun Qiyməti:</label>
                            <input type="number" name="price" class="form-control border">
            
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Məhsulun Stok Vəziyyəti:</label>
                            <div class="form-check">
                                <input type="radio" name="stock" value="1" class="form-check-input">
                                <label class="form-check-label">Ambarda var</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" name="stock" value="0" class="form-check-input">
                                <label class="form-check-label">Ambarda yox</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Məhsulun şəkili:</label>
                            <input type="file" name="file" class="form-control border">
                            <img class="image-preview" src="" alt="">
                        </div>
                        <input type="submit" class="btn btn-success d-block ms-auto" value="Əlavə et">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
