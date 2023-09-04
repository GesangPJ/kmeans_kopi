<div class="col-xl-12">
    <div class="card-box">
        <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Suhu</th>
                            <th>Kelembaban</th>
                            <th>pH</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($log_entries)): ?>
                        <?php foreach ($log_entries as $entry): ?>
                            <tr>
                                <td><?php echo $entry->no; ?></td>
                                <td><?php echo $entry->tanggal; ?></td>
                                <td><?php echo $entry->hari; ?></td>
                                <td><?php echo $entry->waktu; ?></td>
                                <td><?php echo $entry->suhu; ?></td>
                                <td><?php echo $entry->kelembaban; ?></td>
                                <td><?php echo $entry->ph; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No data available.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>