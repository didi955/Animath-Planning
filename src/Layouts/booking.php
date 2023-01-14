<div class="">
    <form method="get" action="">
        <h2 class="pb-3" style="text-align: left;">Quel est le niveau de vos élèves :</h2>
        <select class="form-select" aria-label="Default select example" name="stud_level">
            <option selected>--Choisissez le niveau de vos élèves--</option>
            <option value="p">Primaire</option>
            <option value="c">Collège</option>
            <option value="l">Lycée</option>
        </select>
        <h2 class="pt-4 pb-3" style="text-align: left">Choissiez vos horaires pour la journée :</h2>
        <label class="fs-3" style="text-align: left" for="meeting-time">Début :</label><input class="fs-4 w-100 h-30" type="datetime-local" id="meeting-time"
                                                 name="meeting-time" value="2023-05-25T07:00"
                                                 min="2023-05-25T07:00" max="2023-05-26T19:00">
    </form>

</div>
