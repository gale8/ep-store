<div class="cart">
    <div class="buyer_cart">
        <?php if(isset($_SESSION["user_id"])) : ?>
    <h3>Nakupovalna košara:</h3>

    <?php
            $kosara = isset($_SESSION["cart"]) ? $_SESSION["cart"] : [];

            if ($kosara):
                $znesek = 0;

                foreach ($kosara as $id => $kolicina):
                    $knjiga = NarociloDB::getOne($id);
                    $znesek += $knjiga->cena * $kolicina;
                    ?>
                    <form action="<?= $url ?>" method="post">
                        <input type="hidden" name="do" value="update_cart" />
                        <input type="hidden" name="id" value="<?= $knjiga->id_artikla ?>" />
                        <input type="number" name="kolicina" value="<?= $kolicina ?>"
                               class="short_input" />
                        &times; <?= $knjiga->ime_artikla ?> 
                        <button class="dodaj" type="submit">Posodobi</button> 
                        <input  class="dodaj" type="submit" name="pop" value="Odstrani" />
                    </form>
                   
    
                <?php endforeach; ?>

                <p>Total: <b><?= number_format($znesek, 2) ?> EUR</b></p>

                <form action="<?= $url ?>" method="POST">
                    <input type="hidden" name="do" value="purge_cart" />
                    <input class="dodaj" type="submit" value="Izprazni košarico" />
                </form>
                
                <form action="<?= $url ?>" method="POST">
                    <input type="hidden" name="do" value="send_cart" />
                    <input class="dodaj"  type="submit" value="Oddaj naročilo" />
                </form>
                
            <?php else: ?>
                Nakupovalna košara je prazna.                
            <?php endif; ?>
        <?php endif;?>
    </div>
</div> 