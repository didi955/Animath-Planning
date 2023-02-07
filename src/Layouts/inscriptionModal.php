
    <div class="mb-3 form-floating">
        <input class="form-control verifmail" type="email" id="email" name="email" placeholder="" required>
        <label for="email">Mail :</label>
    </div>
    <div class="mb-3 form-floating">
        <input class="form-control verifname" type="text" id="first_name" name="first_name" placeholder="" required>
        <label for="first_name">Prénom :</label>
    </div>
    <div class="mb-3 form-floating">
        <input class="form-control verifname" type="text" id="last_name" name="last_name" placeholder="" required>
        <label for="last_name">Nom :</label>
    </div>

    <div class="mb-3 form-floating">
        <input class="form-control" type="text" id="school" name="school" placeholder="" required>
        <label for="school">Etablissement scolaire :</label>
    </div>
    <div class="mb-3 form-floating">
        <input class="form-control verifpass" type="password" id="pass" name="pass" placeholder="" required>
        <label for="pass">Mot de passe : </label>
        <div class="invalid-feedback">Le mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule et un chiffre</div>
    </div>
    <div class="mb-3 form-floating">
        <input class="form-control verifpassconfirm" type="password" id="pass_confirm" name="pass_confirm" placeholder="" required>
        <label for="pass_confirm">Confirmation mot de passe : </label>
        <div class="invalid-feedback">Les mots de passe ne correspondent pas</div>
    </div>
    <div class="mb-3">

        <input type="checkbox" name="cgu_accept" id="cgu" class="form-check-input check-must-valid is-invalid"/>
        <label for="cgu">J'accepte les <a data-bs-toggle="modal" href="#cguModalTopbar"><?=e(CGU_TITLE)?></a></label>
        <div class="invalid-feedback">Veuillez accepter les CGU, pour continuer</div>
    </div>
    <div class="mb-3">
        <?php
            $key = parse_ini_file("../hcaptcha.ini")['key'];
        ?>
        <?php if(CAPTCHA_ENABLED):?>
            <div class="h-captcha" data-sitekey="<?= $key ?>"></div>
            <div class="invalid-feedback">Veuillez compléter le Captcha</div>
        <?php endif?>
    </div>
    <div class="modal-footer">
        <input type="submit" id="submit_signup" class="btn btn-primary" value="S'inscrire"/>
    </div>

