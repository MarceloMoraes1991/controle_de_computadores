<?php require_once("header.php"); ?>

<main class="container">
    <div class="row">
        <div class="col s12">
            <form action="" class="row">
                <div class="input-field col s10">
                    <input type="text" name="busca" id="busca">
                    <label for="busca">Digite para buscar</label>
                </div>
                <div class="input-field col s2">
                    <button class="btn"><i class="material-icons">search</i></button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <table class="striped">
                <thead>
                    <tr>
                        <?php if ($_SESSION['perfil'] == 1) { ?>
                            <th>Usuário</th>
                        <?php } ?>
                        <th>Título</th>
                        <th>Data</th>
                        <th class="hide-on-small-only">Hora</th>
                        <th class="hide-on-small-only">Categoria</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($result_tarefas as $tarefa) { ?>
                        <tr>
                            <?php if ($_SESSION['perfil'] == 1) { ?>
                                <td><?= $tarefa['nome'] ?></td>
                            <?php } ?>
                            <td><a href="visualizar_tarefa.php?cod=<?= $tarefa['codt'] ?>"><?= $tarefa['titulo'] ?></a></td>
                            <td><?= date("d/m/Y", strtotime($tarefa['data'])); ?></td>
                            <td class="hide-on-small-only"><?= $tarefa['hora'] ?></td>
                            <?php
                            $cod_tarefa = $tarefa['categoria_cod'];
                            $sql = "SELECT * FROM categoria_tarefa WHERE cod = $cod_tarefa";
                            $result_cat = mysqli_query($con, $sql);
                            $cat_tarefa = mysqli_fetch_array($result_cat);
                            ?>
                            <td class="hide-on-small-only"><?= $cat_tarefa['nome'] ?></td>
                            <td>
                                <a href="editar_tarefa.php?cod=<?= $tarefa['codt'] ?>"><i class="material-icons">edit</i></a>
                                <?php if ($_SESSION['perfil'] == 1) { ?>
                                    <a href="db/excluir_tarefa.php?cod=<?= $tarefa['codt'] ?>"><i class="material-icons">delete</i></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="fixed-action-btn">
        <a href="cadastro_tarefa.php" class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">add</i></a>
    </div>
</main>

<?php require_once "footer.php"; ?>


