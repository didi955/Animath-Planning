
    <div class="mb-3 form-floating">
        <input class="form-control verifmail" type="email" id="email" name="email" placeholder="" required>
        <label for="email">Mail :</label>
    </div>
    <div class="mb-3 form-floating">
        <input class="form-control" type="text" id="first_name" name="first_name" placeholder="" required>
        <label for="first_name">Prénom :</label>
    </div>
    <div class="mb-3 form-floating">
        <input class="form-control" type="text" id="last_name" name="last_name" placeholder="" required>
        <label for="last_name">Nom :</label>
    </div>
    <div class="mb-3 form-floating">
        <input class="form-control verifpass" type="password" id="pass" name="pass" placeholder="" required>
        <label for="pass">Mot de passe : </label>
    </div>
    <div class="mb-3 form-floating">
        <input class="form-control verifpass" type="password" id="pass_confirm" name="pass_confirm" placeholder="" required>
        <label for="pass_confirm">Confirmation mot de passe : </label>
    </div>
    <div class="mb-3">
        <input type="checkbox" name="cgu_accept" id="cgu" class="form-check-input"/>
        <label for="cgu">J'accepte les <a data-bs-toggle="modal" href="#cguModalTopbar"><?=e(CGU_TITLE)?></a></label>
        <div class="invalid-feedback">Veuillez accepter les CGU, pour continuer</div>
    </div>
    <?php
    /*
    $key = parse_ini_file("hcaptcha.ini")['key'];
    echo '<div class="h-captcha" data-sitekey="'. $key .'"></div>';
    */
    ?>
    <div class="modal-footer">
        <input type="submit" id="submit_signup" class="btn btn-primary" value="Envoyer"/>
    </div>

