<?php
function get_navbar(){
    return ' <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="dashboard.php">
                        <span data-feather="home"></span>
                        Dashboard
                        </a>
              </li>
              
              
              <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="mywallet.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                            <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
                            </svg>
                    &nbsp;       Il mio portaglio
                    </a>
             </li>
             
             
             <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="myassets.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pie-chart-fill" viewBox="0 0 16 16">
                            <path d="M15.985 8.5H8.207l-5.5 5.5a8 8 0 0 0 13.277-5.5zM2 13.292A8 8 0 0 1 7.5.015v7.778l-5.5 5.5zM8.5.015V7.5h7.485A8.001 8.001 0 0 0 8.5.015z"/>
                            </svg>
                    &nbsp;       I miei asset
                    </a>
             </li>
             
             
             <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="stockmarket.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z"/>
                        </svg>
                    &nbsp;   Mercato
                    </a>
             </li>
             
             
             <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="acquista.php">
                        <span data-feather="plus"></span>
                        Nuovo asset
                    </a>
             </li>
             
             
             <li class="nav-item">
             <a class="nav-link" aria-current="page" href="vendi.php">
                    <span data-feather="delete"></span>
                    Rimuovi un asset
             </a>
             </li>
             
             <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="logout.php">
                        <span data-feather="log-out"></span>
                        Logout
                    </a>
                </li>';
}
/* Questo file serve per non fare copia e incolla della barra di navigazione.
    Gli SVG sono reperibili nella sezione Icons di Bootrstrap, mentre le feather sono ottenute tramite il collegamento presente in ogni pagina
*/