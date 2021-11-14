<a href="/records/add" class="m-2 float-right btn btn-primary">Add new record</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Type</th>
            <th scope="col">Name</th>
            <th scope="col">Content</th>
            <th scope="col">Ttl</th>
            <th scope="col">Prio</th>
            <th scope="col">Port</th>
            <th scope="col">Weight</th>
            <th scope="col">Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($items as $item) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($item['type']) . '</td>';
            echo '<td>' . htmlspecialchars($item['name']) . '</td>';
            echo '<td>' . htmlspecialchars($item['content']) . '</td>';
            echo '<td>' . htmlspecialchars($item['ttl']) . '</td>';
            $prio = isset($item['prio']) ? htmlspecialchars($item['prio']) : '-';
            echo '<td>' . $prio . '</td>';
            $port = isset($item['port']) ? htmlspecialchars($item['port']) : '-';
            echo '<td>' . $port . '</td>';
            $weight =  isset($item['weight']) ? htmlspecialchars($item['weight']) : '-';
            echo '<td>'.  $weight . '</td>';
            echo '<td>';
            echo '<a class="mx-1 btn btn-warning" href="/records/update/'.$item['id'] . '">Update</a>';
            echo '<a class="mx-1 btn btn-danger" href="/records/delete/'.$item['id'] . '">Delete</a>';
            echo '</td>';            
            echo '</tr>';
        }
        ?>
    </tbody>
</table>