<?php

namespace App\Controller\User\Schedules;

use App\Controller\User\Page;
use App\Http\Request;
use App\Model\Entity\Schedule as EntitySchedule;
use App\Model\Entity\Reason as EntityReason;
use WilliamCosta\DatabaseManager\Pagination;
use App\Utils\View;

class Historic extends Page {

  /**
   * Método responsável por obter a renderização dos itens de agendamento para o histórico
   *
   * @param   Request     $request
   * @param   Pagination  $obPagination
   *
   * @return  string
   */
  private static function getHistoricItems(Request $request, ?Pagination &$obPagination): string {
    // DEPOIMENTOS
    $itens = '';

    // ID DO USUÁRIO
    $id = $_SESSION['ph_login']['usuario']?->id;

    // CLASULA WHERE
    $where = "cod_atendido = $id";

    // QUANTIDADE TOTAL DE AGENDAMENTOS
    $quantidadeTotal = EntitySchedule::getSchedules($where, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

    // PÁGINA ATUAL
    $queryParams = $request->getQueryParams();
    $paginaAtual = $queryParams['page'] ?? 1;

    // LIMITE POR PÁGINA
    $limit = $queryParams['per_page'] ?? 3;
    $limit = is_numeric($limit) ? $limit : 3;

    // VALIDANDO SE DEVE MOSTRAR TODOS
    $limit = $limit > 0 ? $limit : $quantidadeTotal;

    // INSTANCIA DE PAGINAÇÃO
    $obPagination = new Pagination($quantidadeTotal, $paginaAtual, $limit);

    // RESULTADOS DA HISTÓRICO
    $results = EntitySchedule::getSchedules($where, 'data_marcada DESC', $obPagination->getLimit());

    if (EntitySchedule::getSchedules($where, 'data_marcada DESC', $obPagination->getLimit())->fetchAll()) {
      // RENDERIZA O ITEM
      while ($obSchedule = $results->fetchObject(EntitySchedule::class)) {
        if (isset($obSchedule->cod_motivo))
          $motivo = EntityReason::getReasonById($obSchedule->cod_motivo)->descricao;
        else
          $motivo = '<i>Descrito</i>: ' . $obSchedule->descricao;

        $itens .= View::render('user/schedules/historic/item', [
          'motivo' => $motivo,
          'data'   => $obSchedule->data_marcada ?
            date('d/m/Y H:i', strtotime($obSchedule->data_marcada)) : '<i>sem data marcada</i>'
        ]);
      }

      $itens = View::render('user/schedules/historic/box', [
        'item' => $itens,
      ]);
    } else {
      $itens = '<div class="text-center">Não há histórico</div>';
    }

    // RETORNA OS DEPOIMENTOS
    return $itens;
  }

  /**
   * Método responsável por retornar a view do histórico
   *
   * @param   Request  $request
   *
   * @return  string
   */
  // REMINDER: Add Alterar e Excluir os em aberto
  public static function getHistoric(Request $request): string {
    // USUÁRIO LOGADO
    $obUser = $_SESSION['ph_login']['usuario'];

    // NOME COMPLETO DO USUÁRIO REPARTIDO
    $fullname = explode(' ', $obUser->nome, 2);

    // VIEW DA AGENDAMENTO
    $content = View::render('user/schedules/historic', [
      'title_form' => 'Histórico',
      'historic'   => self::getHistoricItems($request, $obPagination),
      'pagination' => parent::getPagination($request, $obPagination),
      'name'       => $fullname[0] ?? '',
      'lastname'   => $fullname[1] ?? '',
      'email'      => $obUser->email,
    ]);

    // RETORNA A VIEW DA PÁGINA 
    return parent::getPage('Histórico', $content);
  }
}
