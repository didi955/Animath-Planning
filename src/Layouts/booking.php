<div class="">
    <form method="post" action="?controller=Reservation&action=filter">
        <div class= "pb-4">
        <h4 class="pb-1"  style="text-align: left;">Quel est le niveau de vos élèves ?</h4>
        <select class="form-select w-50" aria-label="Default select example" name="stud_level">
            <option selected>--Choisissez le niveau de vos élèves--</option>
            <option value="p">Primaire</option>
            <option value="c">Collège</option>
            <option value="l">Lycée</option>
        </select>
        </div>

        <div class="border-2 border-bottom" style="color: #98c1d9"></div>
        <h4 class="pt-3 pb-1" style="text-align: left">Quelles sont vos disponiblités ?</h4>
        <label class="fs-7 pt-1" style="justify-content: left" for="meeting-time">Début :</label>
        <input class="fs-6  w-100 h-30" type="datetime-local" id="meeting-time" name="meeting-time_start" value="2023-05-25T07:00" min="2023-05-25T07:00" max="2023-05-26T19:00">

        <label class="fs-7" style="justify-content: left" for="meeting-time_end">Fin :</label>
        <input class="fs-6  w-100 h-30" type="datetime-local" id="meeting-time" name="meeting-time" value="2023-05-25T18:00" min="2023-05-25T07:00" max="2023-05-26T19:00">
        <br><br>
        <div class="border-2 border-bottom"></div>
        <h4 class="pt-3 pb-1" style="text-align: left">Combien d'élèves accompagnez vous?</h4>
        <select class="form-select w-50"  aria-label="stud_select" name="stud_number">
            <option class="h-25" selected>--Choisissez le nombre d'élèves--</option>
            <?php
            for ($i = 1; $i <= 35; $i++) {
                echo "<option value='" . $i . "'>" . $i . "</option>";
            }
            ?>
        </select>
        <div class="mt-3 d-flex justify-content-end">
            <input type="submit" class="btn btn-info" style="" value="Valider">
        </div>
    </form>


</div>
