<?php
class Main extends Acore
{
    protected function get_hero()
    {
?>
            <!-- Hero Section Begin -->
<section class="hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="hero-text">
                    <h1>Аржааны Тувы</h1>
                    <p>Здесь ты можешь узнать о целебных источниках и озерах Республики Тыва,
                    а также забронировать места в кемпингах.</p>
                    <a href="#" class="primary-btn">Начните путешествие</a>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 offset-xl-2 offset-lg-1">
                <div class="booking-form">
                    <h3>Бронирование Вашего кемпинга</h3>
                    <form action="#">
                        <div class="check-date">
                            <label for="date-in">Приезд:</label>
                            <input type="text" class="date-input" id="date-in">
                            <i class="icon_calendar"></i>
                        </div>
                        <div class="check-date">
                            <label for="date-out">Отъезд:</label>
                            <input type="text" class="date-input" id="date-out">
                            <i class="icon_calendar"></i>
                        </div>
                        <div class="select-option">
                            <label for="guest">Кол-во гостей:</label>
                            <select id="guest">
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4</option>
                                <option value="">5</option>
                                <option value="">6</option>
                                <option value="">7</option>
                            </select>
                        </div>
                        <div class="select-option">
                            <label for="room">Кемпинг:</label>
                            <select id="room">
                                <option value="">1-комнатный</option>
                                <option value="">2-х комнатный</option>
                                <option value="">2-х комнатный</option>
                            </select>
                        </div>
                        <button type="submit">Проверить наличие мест</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="hero-slider owl-carousel">
        <?php
            for ($i=1;$i<4;$i++):
                echo '<div class="hs-item set-bg" data-setbg="img/hero/hero-'.$i.'.jpg"></div>';
            endfor;
        ?>
    </div>
</section>
<?php
    }

    protected function get_room()
    {
?>
<!-- Home Room Section Begin -->
        <section class="hp-room-section">
            <div class="container-fluid">
                <div class="hp-room-items">
                    <div class="row">
                        <?php
                        $sth = $this->dbh->prepare("SELECT id, name, img FROM rooms");
                        $sth->execute();
                        $array = $sth->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($array as $row):
                            printf('<div class="col-lg-3 col-md-6">
                                <div class="hp-room-item set-bg" data-setbg="%s">
                                    <div class="hr-text">
                                        <h3>%s</h3>
                                        <h2>199$<span>/Pernight</span></h2>
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
                                        <a href="#id=%s" class="primary-btn">Подробнее</a>
                                    </div>
                                </div>
                            </div>',$row['img'],$row['name'],$row['id']);
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </section>
<!-- Home Room Section End -->
<?php
    }

    protected function get_blog()
    {
?>
        <!-- Blog Section Begin -->
        <section class="blog-section spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <span>Озера и аржааны Тувы</span>
                            <h2>Наш блог</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
        <?php
        $sth = $this->dbh->prepare("SELECT * 
                                            FROM posts 
                                            ORDER BY RAND() LIMIT 6");
        $sth->execute();
        $array = $sth->fetchAll(PDO::FETCH_ASSOC);
        foreach ($array as $row):
                    printf('<div class="col-lg-4">
                        <div class="blog-item set-bg" data-setbg="%s/blog-1.jpg">
                            <div class="bi-text">
                                <span class="b-tag">%s</span>
                                <h4><a href="?option=view&id=%s">%s</a></h4>
                                <div class="b-time"><i class="icon_clock_alt"> </i>' . date('d.m.Y'). '</div>
                            </div>
                        </div>
                    </div>', $row['img_root'], $row['name'], $row['id'], $row['description']);
        endforeach;
        ?>
                </div>
            </div>
        </section>
        <!-- Blog Section End -->
<?php
    }
    public function get_content()
    {
        $this->get_hero();
        $this->get_room();
        $this->get_blog();
    }
}
