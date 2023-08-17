
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Kateqoriya əlavə et</h5>
                        </div>
                    </div>
                </div>
                <div class="card p-4">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Kateqoriya Adı</label>
                            <input value="" type="text" name="name" class="form-control">
                        </div>
                        <div class="input-group input-group-outline my-3">
                            <label class="d-block">Kateqoriya şəkili</label>
                            <input type="file" name="file" class="form-control w-100 has__image__preview">
                            <img class="image__preview" src="" alt="">
                        </div>
                        <input type="submit" class="btn btn-success d-block ms-auto" value="Əlavə et">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>