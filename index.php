<?php global $especie, $armazenamentos, $cCooperantes, $listaCampos, $dados, $metodo, $buscado; ?>

<form method="post" action="application/view/avalRecebCarga/salvar.php" id="formCad" style=" margin-top: 20px; ">
	<div class="row" style="margin-bottom: 20px;">
		<div class="col-md-2">
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="checkbox" name="metodo[]" <?php echo in_array('L', $metodo) ? 'checked' : '' ?> id="inlineCheckbox1" value="L">
				<label class="form-check-label" for="inlineCheckbox1"> Lavoura </label>
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="checkbox" name="metodo[]" <?php echo in_array('T', $metodo) ? 'checked' : '' ?> id="inlineCheckbox2" value="T">
				<label class="form-check-label" for="inlineCheckbox2"> Transferência </label>
			</div>
		</div>

	</div>

	<div class="row" style="margin-bottom: 20px;">

		<div class="col-md-2">
			<label for="idEspecie"> Espécie </label>
			<select name="idEspecie" id="especie" class="form-control">
				<option value=""> - </option>
				<?php
				foreach($especie as $itemEspecie){
					if ($itemEspecie->status() == 1 || $itemEspecie->idEspecie() == $dados->idEspecie) {
						?>
						<option value="<?php echo $itemEspecie->idEspecie() ?>"><?php echo $itemEspecie->nome() ?></option>
						<?php
					}
				}
				?>
			</select>
		</div>

		<div class="col-md-2">
			<label for="idCultivar"> Cultivar </label>
			<select name="idCultivar" class="form-control">
				<option value="">-</option>
			</select>
		</div>

		<div class="col-md-2">
			<label for="nomeLote">Campo / Coxilha</label>
			<select name="idCampo" class="form-control">
				<option value="">-</option>
			</select>
		</div>

		<div class="col-md-3">
			<label for="Cooperante">Cooperante</label>
			<select name="idCooperante" id="idCooperante" class="custom-select form-control">
				<option value="">-</option>
				<?php
				if($cCooperantes){
					foreach ($cCooperantes as $itemCooperante) {
						echo '<option '.($dados->idCooperante == $itemCooperante->id() ? 'selected' : '').' value="'.$itemCooperante->id().'">'.$itemCooperante->nome().'</option>';
					}
				}
				?>
			</select>
		</div>

		<div class="col-sm-1">
			<label for="moega">MOEGA</label>
			<input class="form-control text-left" type="number" autocomplete="off" style="float: none; display: inline; " value="<?= $dados->moega ?>" name="moega" id="moega" <?= $buscado ? 'readonly' : '' ?>>
		</div>

		<div class="col-md-2">
			<label for="localArmazenagem">Local de Armazenagem</label>
			<select name="localArmazenagem" id="localArmazenagem" class="form-control" <?= $buscado ? 'readonly' : '' ?>>
				<option value="">-</option>
				<?php
				$dom = new DOMDocument();
				
				foreach ($armazenamentos as $armazenamento) {
					$option = $dom->createElement('option', $armazenamento->nome);
					$option->setAttribute('value', $armazenamento->idArmazenamento);
					
					if ($dados->localArmazenagem == $armazenamento->nome || $dados->localArmazenagem == $armazenamento->idArmazenamento) {
						$option->setAttribute('SELECTED', '');
					}
					
					$dom->appendChild($option);
				}
				
				$htmlString = $dom->saveHTML();
				echo $htmlString;
				?>
			</select>
		</div>

	</div>

	<div class="row" style="margin-bottom: 20px;">
		<!--<div class="col-md-2">
			<label>Data e Hora de inicio:</label>
			<div>
				<label for="data">Data</label>
				<input id="data" class="form-control text-center" readonly value="<?php /*echo $dados->data != '' ? formata::data($dados->data) : date('d/m/Y') */?>"  type="text" style="float: none; display: inline; " name="data">
			</div>
			<div>
				<label for="hora">Hora</label>
				<input class="form-control text-center" readonly value="<?php /*echo $dados->hora != '' ? $dados->hora : date('H:i:s') */?>"  type="text" style="float: none; display: inline; " name="hora">
			</div>
		</div>-->

		<div class="col-md-1">

			<label for="data">Data</label>
			<input type="text" readonly value="<?php echo $dados->data != '' ? formata::data($dados->data) : date('d/m/Y') ?>"
				   id="data" class="form-control text-center" style="float: none; display: inline; " name="data">
		</div>
		<div class="col-md-1">
			<label for="hora">Hora</label>
			<input type="text" readonly value="<?php echo $dados->hora != '' ? $dados->hora : date('H:i:s') ?>"
				   id="hora" class="form-control text-center" style="float: none; display: inline; " name="hora">

		</div>

		<div class="col-md-3">
			<label for="romaneio">Romaneio de Produção</label>
			<input class="form-control text-left" type="text" autocomplete="off" style="float: none; display: inline; " value="<?php echo $dados->romaneio ?>" name="romaneio">
		</div>

		<div class="col-md-4">
			<label for="motorista">Motorista</label>
			<input class="form-control" type="text" name="motorista" id="motorista" value="<?= $dados->motorista ?>">
		</div>
		<div class="col-md-3">
			<label for="placaVeiculo">Placa do Veículo</label>
			<input class="form-control" type="text" name="placaVeiculo" id="placaVeiculo" value="<?= $dados->placaVeiculo ?>">
		</div>

	</div>

	<div class="row" style="margin-bottom: 20px;">
		<div class="col-md-5">
			<input type="submit" class="btn btn-info" value="Salvar">
		</div>

		<div class="col-md-5" id="modalButton" hidden>
			<button class="btn btn-info" type="button" id="myBtn">Alterar Local</button>
		</div>
	</div>

	<!--<div id="resultados" hidden>-->
	<div id="resultados" >
		<h3 style="margin-bottom: 20px;">Resultados</h3>

		<div class="row" style="margin-bottom: 20px">
			<div class="col-md-12">
				<label for="observacao">Observação</label>
				<input type="text" name="observacao" autocomplete="off" class="form-control" value="<?php echo $dados->observacao ?>">
			</div>
		</div>

		<div class="row">
			<div class="col-md-5">
				<div class="row">

					<div class="col-md-12">
					<h4 for="observacao">Análise de Impureza</h4>
					</div>
				</div>
				
				<div class="row">

						<div class="col-md-3">
							<label for="">Peso da amostra (g)</label>
							<input class="form-control" type="text" name="pesoAmostra" id="pesoAmostra" value="<?= !empty($dados->pesoAmostra) ? $dados->pesoAmostra : '' ?>">
						</div>
						<div class="col-md-2">
							<label for="">Impureza(g)</label>
							<input class="form-control" type="text" name="impureza" id="impureza" value="<?= !empty($dados->impureza) ? $dados->impureza : '' ?>">
						</div>
						<div class="col-md-3">
							<label for="">(%) Impurezas </label>
							<input readonly="readonly" class="form-control" type="text" name="percenImpureza" id="percenImpureza"
								   value="<?= !empty($dados->percenImpureza) ? $dados->percenImpureza : '' ?>">
						</div>
						<div class="col-sm-2">
							<label for="" class="control-label">% Umidade</label>
							<input class="form-control money" type="text" name="percenUmidade" id=""
								   value="<?= !empty($dados->percenUmidade) ? $dados->percenUmidade : '' ?>">
						</div>
						<div class="col-sm-2">
							<label for="" class="control-label">Temperatura</label>
							<input class="form-control money" type="text" name="temperatura"
								   value="<?= !empty($dados->temperatura) ? $dados->temperatura : '' ?>">
						</div>

					</div>
				
			</div>

			<div class="col-md-7">

				<div class="row">
					<div class="col-md-12">
						<h4 for="observacao">Análise de Hipoclorito</h4>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<label for="" class="control-label">Repetição 1: N° de sem. trincadas</label>
						<input class="form-control" type="text" name="rep1sementeTrocada" id="rep1sementeTrocada" value="<?= !empty($dados->rep1sementeTrocada) ? $dados->rep1sementeTrocada : '' ?>">
					</div>
					<div class="col-sm-2">
						<label for="" class="control-label">%Resultado repetição 1</label>
						<input class="form-control" type="text" name="percenRep1" id="percenRep1" value="<?= !empty($dados->percenRep1) ? $dados->percenRep1 : '' ?>">
					</div>
					<div class="col-sm-2">
						<label for="" class="control-label">Repetição 2: N° de sem. trincadas</label>
						<input class="form-control" type="text" name="rep2sementeTrocada" id="rep2sementeTrocada" value="<?= !empty($dados->rep2sementeTrocada) ? $dados->rep2sementeTrocada : '' ?>">
					</div>
					<div class="col-sm-2">
						<label for="" class="control-label">%Resultado repetição 2</label>
						<input class="form-control" type="text" name="percenRep2" id="percenRep2" value="<?= !empty($dados->percenRep2) ? $dados->percenRep2 : '' ?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-2">
						<label for="" class="control-label">%Trincadas</label>
						<input readonly class="form-control money" type="text" name="percenTrincadas" id="percenTrincadas" value="<?= !empty($dados->percenTrincadas) ? $dados->percenTrincadas : '' ?>">
					</div>
					<div class="col-sm-2">
						<label for="" class="control-label">%Hipoclorito</label>
						<input readonly class="form-control money" type="text" name="percenHipoclorito" id="percenHipoclorito" value="<?= !empty($dados->percenHipoclorito) ? $dados->percenHipoclorito : '' ?>">
					</div>
					<div class="col-sm-2">
						<label for="" class="control-label">%Trincadas + %Hipoclorito</label>
						<input readonly class="form-control money" type="text" name="percenTrinHipo" id="percenTrinHipo" value="<?= !empty($dados->percenTrinHipo) ? $dados->percenTrinHipo : '' ?>">
					</div>
				</div>
				
			</div>
			
		</div>
		<!--
		<div class="row">
			
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-2">
						<label for="">Peso da amostra (g)</label>
						<input class="form-control" type="text" name="pesoAmostra" id="pesoAmostra" value="<?php /*= !empty($dados->pesoAmostra) ? $dados->pesoAmostra : '' */?>">
					</div>
					<div class="col-md-2">
						<label for="">Impureza(g)</label>
						<input class="form-control" type="text" name="impureza" id="impureza" value="<?php /*= !empty($dados->impureza) ? $dados->impureza : '' */?>">
					</div>
					<div class="col-md-2">
						<label for="">(%) Impurezas </label>
						<input readonly="readonly" class="form-control" type="text" name="percenImpureza" id="percenImpureza"
							   value="<?php /*= !empty($dados->percenImpureza) ? $dados->percenImpureza : '' */?>">
					</div>
					<div class="col-sm-2">
						<label for="" class="control-label">% Umidade</label>
						<input class="form-control money" type="text" name="percenUmidade" id=""
							   value="<?php /*= !empty($dados->percenUmidade) ? $dados->percenUmidade : '' */?>">
					</div>
					<div class="col-sm-2">
						<label for="" class="control-label">Temperatura</label>
						<input class="form-control money" type="text" name="temperatura"
							   value="<?php /*= !empty($dados->temperatura) ? $dados->temperatura : '' */?>">
					</div>
					
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<h4 for="observacao">Análise de Hipoclorito</h4>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-2">
					<label for="" class="control-label">Repetição 1: N° de sem. trincadas</label>
					<input class="form-control" type="text" name="rep1sementeTrocada" id="rep1sementeTrocada" value="<?php /*= !empty($dados->rep1sementeTrocada) ? $dados->rep1sementeTrocada : '' */?>">
				</div>
				<div class="col-sm-2">
					<label for="" class="control-label">%Resultado repetição 1</label>
					<input class="form-control" type="text" name="percenRep1" id="percenRep1" value="<?php /*= !empty($dados->percenRep1) ? $dados->percenRep1 : '' */?>">
				</div>
				<div class="col-sm-2">
					<label for="" class="control-label">Repetição 2: N° de sem. trincadas</label>
					<input class="form-control" type="text" name="rep2sementeTrocada" id="rep2sementeTrocada" value="<?php /*= !empty($dados->rep2sementeTrocada) ? $dados->rep2sementeTrocada : '' */?>">
				</div>
				<div class="col-sm-2">
					<label for="" class="control-label">%Resultado repetição 2</label>
					<input class="form-control" type="text" name="percenRep2" id="percenRep2" value="<?php /*= !empty($dados->percenRep2) ? $dados->percenRep2 : '' */?>">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-2">
					<label for="" class="control-label">%Trincadas</label>
					<input readonly class="form-control" type="text" name="percenTrincadas" id="percenTrincadas" value="<?php /*= !empty($dados->percenTrincadas) ? $dados->percenTrincadas : '' */?>">
				</div>
				<div class="col-sm-2">
					<label for="" class="control-label">%Hipoclorito</label>
					<input readonly class="form-control" type="text" name="percenHipoclorito" id="" value="<?php /*= !empty($dados->percenHipoclorito) ? $dados->percenHipoclorito : '' */?>">
				</div>
				<div class="col-sm-2">
					<label for="" class="control-label">%Trincadas + %Hipoclorito</label>
					<input readonly class="form-control" type="text" name="percenTrinHipo" id="" value="<?php /*= !empty($dados->percenTrinHipo) ? $dados->percenTrinHipo : '' */?>">
				</div>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4 for="observacao">Análise de Hipoclorito</h4>
			</div>
		</div>
		
		<div class="row">
			<div class="col-sm-2">
				<label for="" class="control-label">Repetição 1: N° de sem. trincadas</label>
				<input class="form-control" type="text" name="rep1sementeTrocada" id="rep1sementeTrocada" value="<?php /*= !empty($dados->rep1sementeTrocada) ? $dados->rep1sementeTrocada : '' */?>">
			</div>
			<div class="col-sm-2">
				<label for="" class="control-label">%Resultado repetição 1</label>
				<input class="form-control" type="text" name="percenRep1" id="percenRep1" value="<?php /*= !empty($dados->percenRep1) ? $dados->percenRep1 : '' */?>">
			</div>
			<div class="col-sm-2">
				<label for="" class="control-label">Repetição 2: N° de sem. trincadas</label>
				<input class="form-control" type="text" name="rep2sementeTrocada" id="rep2sementeTrocada" value="<?php /*= !empty($dados->rep2sementeTrocada) ? $dados->rep2sementeTrocada : '' */?>">
			</div>
			<div class="col-sm-2">
				<label for="" class="control-label">%Resultado repetição 2</label>
				<input class="form-control" type="text" name="percenRep2" id="percenRep2" value="<?php /*= !empty($dados->percenRep2) ? $dados->percenRep2 : '' */?>">
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">
				<label for="" class="control-label">%Trincadas</label>
				<input readonly class="form-control" type="text" name="percenTrincadas" id="percenTrincadas" value="<?php /*= !empty($dados->percenTrincadas) ? $dados->percenTrincadas : '' */?>">
			</div>
			<div class="col-sm-2">
				<label for="" class="control-label">%Hipoclorito</label>
				<input readonly class="form-control" type="text" name="percenHipoclorito" id="" value="<?php /*= !empty($dados->percenHipoclorito) ? $dados->percenHipoclorito : '' */?>">
			</div>
			<div class="col-sm-2">
				<label for="" class="control-label">%Trincadas + %Hipoclorito</label>
				<input readonly class="form-control" type="text" name="percenTrinHipo" id="" value="<?php /*= !empty($dados->percenTrinHipo) ? $dados->percenTrinHipo : '' */?>">
			</div>
		</div>
-->
		<div class="row">
			<div class="col-md-5">
				<input type="submit" class="btn btn-info" value="Salvar">
			</div>
		</div>
	</div>
	<!-- MODAL ARMAZENAGEM -->
	<style>
        /* The Modal (background) */
        #armazenagemModal .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        #armazenagemModal .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        #armazenagemModal .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

	</style>

	<div id="armazenagemModal" class="modal">
		<!-- Modal content -->
		<div class="modal-content">
			<span class="close">&times;</span>
			<p>Editar Local de Armazenagem</p>

			<div class="row" style="margin-bottom: 20px;">
				<div class="col-sm-1">
					<label for="">MOEGA</label>
					<input class="form-control text-left" type="number" autocomplete="off" style="float: none; display: inline; " value="<?= $dados->altMoega ?>" name="altMoega" id="altMoega">
				</div>

				<div class="col-md-2">
					<label for="">Local de Armazenagem</label>
					<select name="altLocalArmazenagem" id="altLocalArmazenagem" class="form-control">
						<option value="">-</option>
						<?php
						$dom = new DOMDocument();
						
						foreach ($armazenamentos as $armazenamento) {
							$option = $dom->createElement('option', $armazenamento->nome);
							$option->setAttribute('value', $armazenamento->idArmazenamento);
							
							if ($dados->altLocalArmazenagem == $armazenamento->nome || $dados->altLocalArmazenagem == $armazenamento->idArmazenamento) {
								$option->setAttribute('SELECTED', '');
							}
							
							$dom->appendChild($option);
						}
						
						$htmlString = $dom->saveHTML();
						echo $htmlString;
						?>
					</select>
				</div>
			</div>

			<div class="row" style="margin-bottom: 20px;">
				<div class="col-md-12">
					<label for="">Motivo da Alteração</label>
					<input type="text" name="altMotivo" autocomplete="off" class="form-control" value="<?php echo $dados->altMotivo ?>">
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<label>Data e Hora da Alteração:</label>
					<input readonly class="form-control" type="datetime-local" name="altDate" id="altDate">
				</div>
			</div>

			<div class="row" style="margin-top: 10px">
				<div class="col-md-5">
					<input type="submit" class="btn btn-info" value="Salvar">
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" name="idRecebimentoCarga" value="<?php echo $dados->idRecebimentoCarga ?>">
	<input type="hidden" name="stage" value="0">
</form>

<script>
    // Get the modal
    var modal = document.getElementById("armazenagemModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
        $("input[name='stage']").val(1);
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<!-- END -->

<script>
	
	$(document).ready(function(){
        $('.money').maskMoney({decimal: ',', thousands: '.', allowZero: true});

        $('.money2').mask("#.##0,00", {reverse: true});
        
	});
	
	
    var idRecebimentoCarga = <?= ($dados->idRecebimentoCarga != null && $dados->idRecebimentoCarga != '') ? $dados->idRecebimentoCarga : 'null' ?>;
    var idEspecie          = <?= ($dados->idEspecie != null && $dados->idEspecie != '') ? $dados->idEspecie : 'null' ?>;
    var idCultivar         = <?= ($dados->idCultivar != null && $dados->idCultivar != '') ? $dados->idCultivar : 'null' ?>;
    var idCampo            = <?= ($dados->idCampo != null && $dados->idCampo != '') ? $dados->idCampo : 'null' ?>;
    var data               = <?= ($dados->data != null && $dados->data != '') ? $dados->data : 'null' ?>;

    var ph              = <?= ($dados->ph != null && $dados->ph != '') ? $dados->ph : 'null' ?>;
    var graosGerminados = <?= ($dados->graosGerminados != null && $dados->graosGerminados != '') ? $dados->graosGerminados : 'null' ?>;
    var chocos          = <?= ($dados->chocos != null && $dados->chocos != '') ? $dados->chocos : 'null' ?>;
    var aveiasOutros    = <?= ($dados->aveiasOutros != null && $dados->aveiasOutros != '') ? $dados->aveiasOutros : 'null' ?>;

    $('input[name="graosGerminados"]').on('input', fixaNumero);
    $('input[name="chocos"]').on('input', fixaNumero);
    $('input[name="aveiasOutros"]').on('input', fixaNumero);

    const buscado = <?= $buscado ? 'true' : 'false' ?>;

    if (buscado) {
        $("#resultados").prop("hidden", false);
        $('#modalButton').prop("hidden", false);
    }

    function fixaNumero(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    }

    function checkFields() {
        ocultaLoader();

        //First Stage
        let lavouraChecked = $("#inlineCheckbox1").is(":checked");
        let transfeChecked = $("#inlineCheckbox2").is(":checked");
        if (!lavouraChecked && !transfeChecked) {
            alert('Informe Lavoura e/ou Tranferência!');
            return false;
        }

        let moega = $("#moega");
        let localArmazenagem = $("#localArmazenagem");
        if (moega.val() != '' || localArmazenagem.val() != '') {
            moega.prop( "disabled", true );
            localArmazenagem.prop( "disabled", true );
        }

        let arrayFields = [
            $('#especie').val(),
            $('input[name="romaneio"]').val(),
            $('select[name="idCultivar"]').val(),
            $('select[name="idCampo"]').val(),
            $('#idCooperante').val(),
            moega.val(),
            localArmazenagem.val()
        ];

        if (arrayFields.includes('')) {
            console.log('arrayFields', arrayFields);

            alert("Preencha todos os campos antes de salvar.");
            return false;
        }

        // //Second Stage
        // let idEspecie = $('select[name="idEspecie"]').val();
        // let romaneio = $('input[name="romaneio"]').val();
        // let dmi = $('#dmi').val();

        // if (romaneio == "") {
        //     alert("Campo Romaneio de Produção é obrigatório.");
        //     return false;
        // }

        // if ((idEspecie != 6 && idEspecie != 15) && dmi == '') {
        //     alert("Campo Hipoclorito + SE + DP não pode estar vazio.");
        //     return false;
        // }

        // if($('#formCad').find('[name="autorizacaoDescarga"]').val() == '' && $('#formCad').find('#status').val() == 'REPROVADO') {
        //     alert('Informe o usuário que autorizou a colheita!');
        //     $('#formCad').find('[name="autorizacaoDescarga"]').focus();
        //     return false;
        // }
    }

    $('#formCad').submit(function (e) {
        e.preventDefault();
        exibeLoader();

        $(this).ajaxSubmit({
            dataType: 'JSON',
            beforeSubmit: checkFields,
            // data: $(this).serialize(),
            success: function(response){
                if(response.cod == 1){
                    alert(response.msg);
                    if(response.stage == 0){
                        $("input[name='idRecebimentoCarga']").val(response.idRecebimentoCarga);
					}
                }

                if(response.stage == 1) {
                    $("#altLocalArmazenagem").val($("#localArmazenagem").val());
                    $("#moega").val($("#altMoega").val());
                    $("input[name='stage']").val(0);
                }
                
                if(response.closeModal == 1) {
                    let modal = document.getElementById("armazenagemModal");
                    modal.style.display = "none";
				}
                
                
                console.log('response', response);
                
                $('#modalButton').prop("hidden", false);
                $("#resultados").prop("hidden", false);
            },
            error: function(jqXHR){
                alert(jqXHR.responseText);
                ocultaLoader();
            }
        });

        // $.ajax({
        //     type: "POST",
        //     url: "post.php",
        //     data: $(this).serialize(),
        //     success: function (data) {
        //         console.log(data);
        //         $('.result').html(data);
        //     }
        // });
    });

    /*$('#formCad').on('submit', function(e){
        e.preventDefault();
        exibeLoader();

        $(this).ajaxSubmit({
            dataType: 'JSON',
            beforeSubmit: checkFields,
            success: function(response){
                if(response.cod == 1){
                    alert(response.msg);

                    if(idRecebimentoCarga != null){
                        $('#modaFormEditaRecebimentoCarga').modal('hide');
                        $('#modalButton').prop("hidden", false);
                    }
                    // else {
                    //     seleciona('conteudo', 'avalRecebCarga', 'form');
                    // }

                    ocultaLoader();
                }

            },
            error: function(jqXHR){
                alert(jqXHR.responseText);
                ocultaLoader();
            }
        });
    });*/

    $('#formCad').find('[name="idEspecie"]').on('change', function () {
        let tdParent = $(this).closest('.row');
        let idEspecie = $(this).val();
        let objCultivar = tdParent.find('[name="idCultivar"]');
        let objCampo = tdParent.find('[name="idCampo"]');
        let data = $("#data").val();
        let ano = new Date().getFullYear();

        $("#status").val('');

        if (idEspecie == 6 || idEspecie == 15) {
            $('div[name="wheatFields"]').show();
            $('div[name="commonFields"]').hide();

            $("input[name='hipoclorito']").val('0');
            $("input[name='se']").val('0');
            $("input[name='dp']").val('0');
            $("#dmi").val(0);
        } else {
            $('div[name="wheatFields"]').hide();
            $('div[name="commonFields"]').show();
        }

        if (data != '') {
            ano = data.substring(6);
        }

        objCultivar.prop('disabled', true).empty().html('<option value="">-</option>');
        objCampo.prop('disabled', true).empty().html('<option value="">-</option>');

        function respostaCultivar (dados) {
            if(dados.length > 0) {

                dados.forEach(item => {
                    objCultivar.append('<option value="'+item.idCultivar+'">'+item.nome+'</option>');
                });

            }

            objCultivar.prop('disabled', false);

            if(idRecebimentoCarga != null){
                objCultivar.val(idCultivar).trigger('change');
            }
        }

        function respostaCampos (dados) {
            if (dados.length > 0) {
                dados.forEach(item => {
                    objCampo.append('<option value="'+item.idCampoCoxilha+'">'+item.nome+'</option>');
                });
            }

            objCampo.prop('disabled', false);
            if(idRecebimentoCarga != null){
                objCampo.val(idCampo).trigger('change');
            }
        }

        $.post('application/view/cultivar/json_options.php', { idEspecie: idEspecie }, respostaCultivar, 'json');
        $.post('application/view/campoCoxilha/json_options.php', { idEspecie: idEspecie, ano: ano, idCampoCoxilha: idCampo }, respostaCampos, 'json');
    });

    /*function calculoStatus(){
        let form = $('#formCad');
        let status = form.find('#status');
        let dmi = form.find('#dmi');
        let idEspecie = $('input[name="idEspecie"]').val();

        //Só executar calculoStatus se as espécies não forem [TRIGO, trigo]
        if (idEspecie != 6 || idEspecie != 15) {
            let se = parseInt(form.find('[name="se"]').val() != '' ? form.find('[name="se"]').val() : 0);
            let dp = parseInt(form.find('[name="dp"]').val() != '' ? form.find('[name="dp"]').val() : 0);

            let danoImediato = parseInt(form.find('[name="danoImediato"]').val() != '' ? form.find('[name="danoImediato"]').val() : 0);
            let danoLatente = parseInt(form.find('[name="danoLatente"]').val() != '' ? form.find('[name="danoLatente"]').val() : 0);
            let hipoclorito = parseInt(form.find('[name="hipoclorito"]').val() != '' ? form.find('[name="hipoclorito"]').val() : 0);

            // let valorDmi = (danoImediato + hipoclorito);
            let valorDmi = (dp + se + hipoclorito);

            dmi.val(valorDmi);

            $('#campoNomeAutorizacaoDescarga').hide();

            if(se > 7) {

                status.val('REPROVADO');

                $('#campoNomeAutorizacaoDescarga').show();

            } else {

                let padraoColheita = valorDmi - se - dp;

                if(valorDmi <= 15) {
                    status.val('APROVADO');
                }else{
                    status.val('REPROVADO');

                    $('#campoNomeAutorizacaoDescarga').show();
                }

            }
        }
    }*/

    // $('input[name="impureza"]').on('input', function () {
    //     regraStatusTrigo();
    // });

    // $('input[name="aveiasOutros"]').on('input', function () {
    //     regraStatusTrigo();
    // });

    function regraStatusTrigo(){
        let idEspecie = $('[name="idEspecie"]').val();

        if (idEspecie == 6 || idEspecie == 15){
            let aveia = $('input[name="aveiasOutros"]').val();
            let impureza = parseFloat($('input[name="impureza"]').val().replace(',', '.'));
            let descarregarCargaPor = $("input[name='descarregarCargaPor']");
            let descarregarCargaPorDiv = $("div[name='descarregarCargaPorDiv']");
            let status = $("#status");

            if ((aveia < 6) && (impureza < 2)) {
                status.val('APROVADO');
                descarregarCargaPor.trigger('change');
                descarregarCargaPorDiv.hide();
            } else {
                status.val('Contactar o técnico');
                descarregarCargaPor.trigger("change");
                descarregarCargaPorDiv.show();
            }
        }
    }

    // $('.calculaStatus').on('blur', calculoStatus);

    if(idRecebimentoCarga != null) {

        $('#formCad').find('[name="idEspecie"]').val(idEspecie).trigger('change');

    }

    // Prevents ENTER key from triggering submit button
    $(window).ready(function() {
        $("#formCad").on("keypress", function (event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });

        const pesoAmostraInput = $('#pesoAmostra');
        const impurezaInput = $('#impureza');
        const percenImpurezaInput = $('#percenImpureza');

        // console.log(pesoAmostraInput, impurezaInput, percenImpurezaInput);

        function calcPercenImpureza() {
            const pesoAmostra = pesoAmostraInput.val();
            const impureza = impurezaInput.val();

            // percentual de impureza sobre peso da amostra, com 2 casas decimais
			const percenImpureza = ((impureza * 100) / pesoAmostra ).toFixed(2).toString().replace('.', ',');

            percenImpurezaInput.val(percenImpureza);
        }

        pesoAmostraInput.on('keyup', calcPercenImpureza);
        impurezaInput.on('keyup', calcPercenImpureza);


        // Get the current date and time
        const now = new Date();
        const timezoneOffset = -180; // TIMEZONE GMT -3
        const dateInTimezone = new Date(now.getTime() + (timezoneOffset * 60 * 1000));

        const datetimeString = dateInTimezone.toISOString().slice(0, 16);
        // console.log(datetimeString);
        $('#altDate').val(datetimeString);

        function getAverage(a, b) {
            return Number((Number(a) + Number(b)) / 2).toFixed(2).toString().replace('.', ',');
        }

        $("#rep1sementeTrocada").on("input", function() {
            $("#percenTrincadas").val(getAverage($(this).val(), $("#rep2sementeTrocada").val()));
        });

        $("#rep2sementeTrocada").on("input", function() {
            $("#percenTrincadas").val(getAverage($(this).val(), $("#rep1sementeTrocada").val()));
        });

        $("#percenRep1").on("input", function() {
            $("#percenHipoclorito").val(getAverage($(this).val(), $("#percenRep2").val()));
        });

        $("#percenRep2").on("input", function() {
            $("#percenHipoclorito").val(getAverage($(this).val(), $("#percenRep1").val()));
        });
        
        setInterval(function(){
            let resultado = moeda2float($("#percenHipoclorito").val()) + moeda2float($("#percenTrincadas").val());
            $("#percenTrinHipo").val(resultado.toFixed(2).toString().replace('.', ','));
		}, 500);
    
    });
</script>
