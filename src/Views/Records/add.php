<form id="addRecord" method="POST">
    <div class="form-group">
        <label for="name">Name *</label>
        <input required name="name" type="text" class="form-control" id="name" placeholder="Enter name" value="<?php if (isset($form['name'])) echo $form['name'];
                                                                                                                else echo ""; ?>">
    </div>
    <div class="form-group">
        <label for="content">Content *</label>
        <input requred name="content" type="text" class="form-control <?php if (isset($errors['content'])) echo 'is-invalid'; ?>" id="content" placeholder="Enter content" value="<?php if (isset($form['content'])) echo $form['content'];
                                                                                                                                                                                    else echo ""; ?>">
        <?php if (isset($errors['content'])) echo '<small class="text-danger">' . $errors['content'] . "</small>"; ?>
    </div>
    <div class="form-group">
        <label for="ttl">ttl</label>
        <input type="text" name="ttl" class="form-control" id="ttl" placeholder="Enter ttl" value="<?php if (isset($form['ttl'])) echo $form['ttl'];
                                                                                                    else echo ""; ?>">
    </div>
    <div class="form-group">
        <label for="type">Type *</label>
        <select name="type" class="form-control" id="type">
            <?php
            $items = ['A', 'AAAA', 'MX', 'ANAME', 'CNAME', 'NS', 'TXT', 'SRV'];
            foreach ($items as $item) {
                if (isset($form['type']) && $form['type'] == $item) {
                    echo '<option selected>' . $item . '</option>';
                    continue;
                }
                echo '<option>' . $item . '</option>';
            }
            ?>
        </select>
    </div>

    <?php
    if (true === isset($form['type']) && ($form['type'] == 'MX' || $form['type'] == 'SRV')) {
        echo '<div class="form-group">';
        echo '<label for="prio">Prio</label>';
        $prioValue = isset($form['prio']) ? $form['prio'] : '';
        $prioValid = isset($errors['prio']) ? 'is_invalid' : '';
        echo '<input required type="string" class="form-control generated' . $prioValid . '" name="prio" id="prio" value="' . $prioValue . '" placeholder="Enter prio">';
        if (isset($errors['prio'])) {
            echo '<small class="text-danger generated">' . $errors['prio'] . "</small>";
        }
        echo '</div>';

        if ($form['type'] === 'SRV') {
            echo '<div class="form-group">';
            echo '<label for="port">Port</label>';
            $portValue = isset($form['port']) ? $form['port'] : '';
            $portValid = isset($errors['port']) ? 'is_invalid' : '';
            echo '<input required type="string" class="form-control generated' . $portValid . '" name="port" id="port" value="' . $portValue . '" placeholder="Enter port">';
            if (isset($errors['port'])) {
                echo '<small class="text-danger generated">' . $errors['port'] . "</small>";
            }
            echo '</div>';

            echo '<div class="form-group">';
            echo '<label for="weight">Weight</label>';
            $weightValue = isset($form['weight']) ? $form['weight'] : '';
            $weightValid = isset($errors['weight']) ? 'is_invalid' : '';
            echo '<input required type="string" class="form-control generated' . $weightValid . '" name="weight" id="weight" value="' . $weightValue . '" placeholder="Enter weight">';
            if (isset($errors['weight'])) {
                echo '<small class="text-danger generated">' . $errors['weight'] . "</small>";
            }
            echo '</div>';
        }
    }
    ?>
    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
</form>