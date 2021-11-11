<?= $this->extend('layout/_layoutLogin') ?>

<?= $this->section('content') ?>
<div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">E-REKBOS</h3></div>
                                    <div class="card-body">
                                        <form action="login/auth" method="post" id="form">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com" />
                                                <label for="email">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="password" name="password" type="password" placeholder="Password" />
                                                <label for="password">Password</label>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">Login</button>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                    <?php if(session()->getFlashdata('msg')):?>
                                        <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                                    <?php endif;?>
                                   
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>


<?= $this->endSection() ?>