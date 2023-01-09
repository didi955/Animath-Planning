<h1 >
    Choisissez vos horaires :
</h1>


<div class="date">
    <div class="data-debut">
        <label for="start-date">Horaire de début :</label>
        <input type="datetime-local" id="start-date"
               name="meeting-time" value="2018-06-12T19:30"
               min="2018-06-07T00:00" max="2018-06-14T00:00">
    </div>
    <div class="data-fin">
        <label for="end-date">Horaire de fin:</label>
        <input type="datetime-local" id="end-date"
               name="meeting-time" value="2018-06-12T19:30"
               min="2018-06-07T00:00" max="2018-06-14T00:00">

    </div>
</div>

<h1>
    Choisissez le nombre d'élèves :
</h1>

<div class="form-group col-md-4">
    <label for="inputState">Nombres d'élèves</label>
    <select id="inputState" class="form-control">
        <option selected>...</option>
        <?php
        for ($i = 1; $i <= 30; $i++) {
            echo "<option>$i</option>";
        }
        ?>
    </select>
</div>

