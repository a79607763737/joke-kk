<?php

class view extends Acore {
    public function get_content(){
        if (!$_GET['id']){	echo 'Неправильные данные для вывода статьи';	}
        else{	//перевод в целочисленный тип
            $id_text=(int)$_GET['id'];
            if (!$id_text){	echo 'Неправильные данные для вывода статьи2';	}
            else {
                ?>
                <!-- Breadcrumb Section Begin -->
                <div class="breadcrumb-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="breadcrumb-text">
                                    <h2>Аржааны</h2>
                                    <div class="bt-option">
                                        <a href="index.php">Главная</a>
                                        <span>Аржааны</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Breadcrumb Section End -->
                <?php
                $sth = $this->dbh->prepare("SELECT * FROM posts WHERE id=". intval($_GET['id']));
                $sth->execute();
                $post = $sth->fetch(PDO::FETCH_ASSOC);
                if($post):
                    ?>
                    <!-- Room Details Section Begin -->
                    <section class="room-details-section spad">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="room-details-item">
                                        <img src="<?= $post['img_root'] ?>/blog-1.jpg" alt="">
                                        <div class="rd-text">
                                            <div class="rd-title">
                                                <h3><?= $post['name'] ?></h3>
                                                <div class="rdt-right">
                                                    <div class="rating">
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star"></i>
                                                        <i class="icon_star-half_alt"></i>
                                                    </div>
                                                    <a href="#">Забронировать</a>
                                                </div>
                                            </div>
                                            <h2>159$<span>/Pernight</span></h2>
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td class="r-o">Size:</td>
                                                    <td>30 ft</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Capacity:</td>
                                                    <td>Max persion 5</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Bed:</td>
                                                    <td>King Beds</td>
                                                </tr>
                                                <tr>
                                                    <td class="r-o">Services:</td>
                                                    <td>Wifi, Television, Bathroom,...</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <p class="f-para">
                                                <?= $post['text']?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="rd-reviews">
                                        <h4>Отзывы</h4>
                                        <div class="review-item">
                                            <div class="ri-pic">
                                                <img src="img/room/avatar/avatar-1.jpg" alt="">
                                            </div>
                                            <div class="ri-text">
                                                <span><?= date('d.m.Y') ?></span>
                                                <div class="rating">
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star-half_alt"></i>
                                                </div>
                                                <h5>Иванов Иван</h5>
                                                <p>Отличное место отдыха и перезагрузки! Заряда для тела и души на весь год обеспечен.</p>
                                            </div>
                                        </div>
                                        <div class="review-item">
                                            <div class="ri-pic">
                                                <img src="img/room/avatar/avatar-2.jpg" alt="">
                                            </div>
                                            <div class="ri-text">
                                                <span><?= date('d.m.Y') ?></span>
                                                <div class="rating">
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star"></i>
                                                    <i class="icon_star-half_alt"></i>
                                                </div>
                                                <h5>Валерия Петрова</h5>
                                                <p>Спасибо за теплый прием. Очень красивое место и бодрящие источники. На следующий год обязательно приедем.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review-add">
                                        <h4>Add Review</h4>
                                        <form action="#" class="ra-form">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Name*">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" placeholder="Email*">
                                                </div>
                                                <div class="col-lg-12">
                                                    <div>
                                                        <h5>You Rating:</h5>
                                                        <div class="rating">
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star"></i>
                                                            <i class="icon_star-half_alt"></i>
                                                        </div>
                                                    </div>
                                                    <textarea placeholder="Your Review"></textarea>
                                                    <button type="submit">Submit Now</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="room-booking">
                                        <h3>Your Reservation</h3>
                                        <form action="#">
                                            <div class="check-date">
                                                <label for="date-in">Check In:</label>
                                                <input type="text" class="date-input" id="date-in">
                                                <i class="icon_calendar"></i>
                                            </div>
                                            <div class="check-date">
                                                <label for="date-out">Check Out:</label>
                                                <input type="text" class="date-input" id="date-out">
                                                <i class="icon_calendar"></i>
                                            </div>
                                            <div class="select-option">
                                                <label for="guest">Guests:</label>
                                                <select id="guest">
                                                    <option value="">3 Adults</option>
                                                </select>
                                            </div>
                                            <div class="select-option">
                                                <label for="room">Room:</label>
                                                <select id="room">
                                                    <option value="">1 Room</option>
                                                </select>
                                            </div>
                                            <button type="submit">Check Availability</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Room Details Section End -->
                <?php
                else:
                    header('Location:404.php');
                endif;
            }	}
    }
}
