<div>
            <ul class="pagination">
                <li class="page-item ">
                    <a class="page-link <?= $activePrev ? "disabled" : ""?>" href="<?= "?genre=".$_GET['genre']."&currentPage=prev,".$currentPage?>">&laquo;</a>
                </li>
                
                <?php
                    for ($i=1; $i < $nbpage; $i++):?> 
                    <li class='page-item'>
                        <a class='page-link <?= $i === $activePage ? "disabled" : ""?>' href='
                        <?= "?genre=".$_GET['genre']."&currentPage=$i"?>'><?=$i?></a>
                    </li>
                    <?php endfor ?>
                <li class="page-item">
                    <a class="page-link <?= $activeNext ? "disabled" : ""?>" href="<?= "?genre=".$_GET['genre']."&currentPage=next,".$currentPage?>">&raquo;</a>
                </li>
            </ul>
        </div>