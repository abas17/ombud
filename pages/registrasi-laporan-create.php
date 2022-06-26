<div id="main">
    <div class="row">
        <div class="pt-3 pb-1" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Registrasi Laporan</span></h5>
                    </div>
                    <div class="col s12 m6 l6 right-align-md">
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="?page=home">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="?page=registrasi-laporan">Registrasi Laporan</a>
                            </li>
                            <li class="breadcrumb-item active">Registrasi Laporan Masuk
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <div class="seaction">

                    <div class="card">
                        <div class="card-content">
                            <h4 class="card-title mb-3">Laporan Masuk</h4>
                            <form>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="date" id="tanggal-agenda">
                                        <label for="tanggal-agenda">Tanggal Agenda</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <div>
                                            <label for="tanggal-agenda">Tipe Laporan</label>
                                        </div>
                                        <select class="select2 browser-default">
                                            <option value="1">Laporan Masyarakat</option>
                                            <option value="2">Respon Cepat</option>
                                            <option value="3">Konsultasi Non Laporan</option>
                                            <option value="4">Tembusan</option>
                                            <option value="5">Investigasi atas Prakarsa Sendiri</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col s12">
                                        <div>
                                            <label for="tanggal-agenda">Cara Penyampaian</label>
                                        </div>
                                        <select class="select2 browser-default">
                                            <option value="1">Surat</option>
                                            <option value="2">Datang Langsung</option>
                                            <option value="3">Email</option>
                                            <option value="4">Call Center 137</option>
                                            <option value="5">Telepon</option>
                                            <option value="6">Website</option>
                                            <option value="7">Media Sosial</option>
                                            <option value="8">Whatsapp</option>
                                            <option value="9">PVL On The Spot</option>
                                            <option value="10">Lain-lain</option>
                                            <option value="11">Faksimile</option>
                                            <option value="12">Investigasi Inisiatif</option>
                                            <option value="13">SP4N-LAPOR!</option>
                                            <option value="14">Posko Covid19</option>
                                            <option value="15">Aplikasi Radius</option>
                                            <option value="16">Konsultasi Daring</option>
                                        </select>
                                    </div>
                                </div>


                                <!-- <div class="row">
                                    <div class="input-field col s12">
                                        <label for="tipe-laporan">Tipe Laporan</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="cara-penyampaian">Cara Penyampaian</label>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
                <div class="content-overlay"></div>
            </div>
        </div>
    </div>

    <?php include 'partials/scripts.php'; ?>