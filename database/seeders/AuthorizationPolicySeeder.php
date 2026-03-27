<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorizationPolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("authorization_policies")->insert([
                        ["title"=>"P1","description"=>"Los titulos valores firmados serán devueltos al deudor (a) y/o fiador (a), una vez esten a PAZ Y SALVO las cuentas que avalen este titulo valor.
                        Ejs: Si el deudor (a) canceló la totalidad de la deuda pero aún es fiador (a) de una o mas cuentas que aún permanezcan activas, no se entregará dicho titulo valor hasta que las cuentas queden saldadas."],
                        ["title"=>"P2","description"=>"Una vez cancelado el credito y siempre y cuando el deudor (a) no sea fiador (a) solidario (a) de otra cuenta, el acreedor entregará el (los) titulos valores en el lugar que ambos decidan. El costo de este envío por concepto de transporte o envío a otra ciudad o esta misma ciudad a traves de mensajeria o moto (local) sera asumida por el deudor (a)"],
                        ["title"=>"P3","description"=>"La tasa acordada para esta negociación es el porcentaje acordado entre las partes (mes y/o fracción)"],
                        ["title"=>"P4","description"=>"En caso de hacer acuerdo de pago entre deudor (a) y acreedor, ese nuevo valor o tasa acordada está sujeto al buen comportamiento de pago. Y este acuerdo aplica para pagos cumplidos y completos.
                        Cumplidos: Que el valor cancelado sea en las fechas acordadas
                        Completo: Que el valor de la cuota cancelada sea el acordado y no un pago fraccionado.
                        En caso que los pagos no sean cumplidos y ni completos, perdería automáticamente ese beneficio"],
                        ["title"=>"P5","description"=>"Por cada crédito de $ 500.000 otorgado, el deudor (a) debe tener un fiador (a) que avale o respalde la operación. En caso de no tener fidor (a) adicional, la tasa de negociación será reajustada previo acuerdo entre las partes."],
                        ["title"=>"P6","description"=>"En caso que el pago del interes efectuado por el deudor (a) sea incompleto, la diferencia entre el valor del interes a pagar y el valor pagado, será adicionado a la deuda y generará interés a la tasa inicialmente negociada entre deudor (a) y acreedor.
                        Nuestra empresa cobra interes sobre saldo de interes no pagado."],
                        ["title"=>"P7","description"=>"Sobre la marcha del crédito, el cliente puede solicitar cambios en las fechas de pago. Ese cambio en las fechas de pago trae consigo reajuste en la cartera y el sistema calcula los dias adicionales a cobrar en el próximo pago. Es responsabilidad del acreedor socializar al deudor (a) el nuevo valor a pagar en la nueva fecha de pago solicitada."],
                        ["title"=>"P8","description"=>"Los titulos valores  deben ser firmados en presencia del acreedor y no de manera virtual."],
                        ["title"=>"P9","description"=>"Una vez se avale el crédito por parte del acreedor, éste solicitará la firma de titulos valores para respaldar el crédito. Para este evento, el acredor enviará a una persona de su total confianza para la (s) firma (s) del (los) titulo (s) valor (es). El costo que acarree la obtención de esa (s) firma (s) será asumido por el deudor (a). En caso que el deudor (a) no tenga el valor a cancelar, entonces el acreedor (a) descontará el valor del domicilio al crédito solicitado y desembolsará la diferencia."],
                        ["title"=>"P10","description"=>"Nuestra empresa no congela deudas"],
                        ["title"=>"P11","description"=>"Para la obtención del crédito con nuestra empresa, se requiere la firma de dos (2) titulos valores, firmar comprobante de egreso en blanco, adjuntar la información que solicita el acreedor y diligenciar la información en link que el acreedor envíe"],
                        ["title"=>"P12","description"=>"En caso que el nuevo cliente resida en otra ciudad, el acreedor enviará al cliente via whatsApp o mail documento titulo valor llamado PAGARE. Este documento debe solamente firmarlo el cliente en la notaría local más cercana de la ciudad donde se encuentre el cliente, no debe diligenciar ningun campo ni colocar fechas y una vez firmado y autenticado en notaria local (ciudad donde reside cliente), debe proceder al envío a la ciudad de Barranquilla o donde el acreedor disponga.
                        El costo del envio de este documento será asumido por cliente.
                        Una vez cliente efectúe el pago de la totalidad de la cuenta, el costo del envío igualmente será asumido por el cliente."],
                        ["title"=>"P13","description"=>"Nuestra empresa se abstiene de tener relaciones comerciales directas con policias, militares, trabajadores FOPEP, trabajadores FOMAG, trabajadores magisterio, profesores activos, profesores pensionados, pensionados, políticos, trabajadores de la secretaría distrital de educación, trabajadores de la secretaría departamental de educación, abogados e independientes.
                        Sin embargo para que una de las anteriores personas accedan a un crédito con nuestra empresa, se requiere dos (s) fiador (es) solidario (s)."],
                        ["title"=>"P14","description"=>"Prestamos efectuados durante el mes (inicios, mediados o antes de finalizar el mes), seran cobrados al finalizar el mes a la misma tasa porcentual % acordada desde el inicio de la negociacion."],
                        ["title"=>"P15","description"=>"Nuestra empresa en caso de tener deudores morosos, envío al lugar de trabajo y/o lugar de residencia a cobradores autorizados para gestionar el pago y evitar inicio de pleitos legales."],
                        ["title"=>"P16","description"=>"En caso que el cliente, solicite cambio en fechas de pago (día 30 a día 15 y viceversa, día 5 a día 20 y viceversa), el ACREEDOR calculará esos 15 días adicionales de interés con base en el saldo de cartera a la fecha y este valor será asumido y pagado por cliente por UNA SOLA VEZ. Todo cambio en fechas de pago, tiene un costo financiero que debe ser asumido por el CLIENTE."],
                        ["title"=>"A1","description"=>"Autorizo al acreedor, EN CASO DE NO PAGO DE LAS CUOTAS ACORDADAS por más de sesenta (60) dias de NOTIFICAR de manera virtual y presencial a través de AVISO DE COBRO PREJURIDICO tanto a mí como DEUDOR y a mi FIADOR (ES) SOLIDARIO (S) en cada uno de nuestros lugares de residencia y de trabajo."],
                        ["title"=>"A2","description"=>"Autorizo al acreedor, EN CASO DE NOTIFICACION DE AVISO DE COBRO PREJURIDICO adicionar a mi deuda (Cartera), por concepto de honorarios de abogados el 30% del valor adeudado a la fecha. En todo caso ese valor adicionado NUNCA será inferior a 1 SMLV (Salario mínimo legal vigente del año en curso)
                        Este rubro o ese costo de honorarios cobrados por los abogados (as), legalmente debe ser asumido por el DEUDOR MOROSO.
                        La única manera de evitar el cobro de este rubro, es que el cliente pague sus cuotas acordadas en el tiempo previsto y acordado entre el DEUDOR y EL ACREEDOR."],
                        ["title"=>"A3","description"=>"Autorizo al acreedor, EN CASO DE INICIO DE PROCESO LEGAL adicionar a mi deuda, además de los honorarios de los abogados, las costas del proceso y todo gasto adicional que se incurra en el proceso de demanda ejecutiva."],
                        ["title"=>"A4","description"=>"Autorizo al acreedor, EN CASO DE INICIO DE PROCESO LEGAL diligenciar y hacer efectivo cada uno de los títulos valores firmados por mí o mi FIADOR SOLIDARIO / CODEUDOR, por el valor que a juicio del ACREEDOR este adeudando por concepto de cartera morosa, interés vencido, interés moratorio (máxima tasa legal permitida), honorarios legales, costas del proceso, búsqueda de información en plataformas digitales."],
                        ["title"=>"A5","description"=>"Acepto, EN CASO DE RADICACION DE DEMANDA EJECUTIVA a la empresa donde presto mis servicios y/o presta sus servicios  mi FIADOR el valor liquidado por el juzgado referente a mi demanda."],
                        ["title"=>"A6","description"=>"Autorizo al acreedor, EN CASO DE SER DEUDOR MOROSO y de haber cambiado de empresa y no haberle notificado dicho cambio o reportarle mi nueva vinculación laboral, adicionar a mi deuda el valor de la cuarta parte del salario minimo legal vigente (SMLV) a la fecha, por concepto de honorarios del Dpto. Administrativo por búsqueda en plataformas digitales la información tendiente a conseguir la nueva vinculación contractual y desconocida por el acreedor."],
                        ["title"=>"A7","description"=>"Autorizo al acreedor, EN CASO DE PAGO INCOMPLETO O FRACCIONADO de la cuota interés por pagar, adicionar ese valor pendiente de interés a mi deuda. En este caso, ese saldo adicionado por concepto de interés o saldo de interés no pagado generaría interés a la misma tasa acordada entre DEUDOR y ACREEDOR."],
                        ["title"=>"A8","description"=>"Autorizo al acreedor, EN CASO QUE SEA NECESARIO DE TRASLADARSE hasta donde el DEUDOR ya sea para firmar títulos valores, buscar documentos o recoger el pago por concepto de cuota acordada y pactada entre DEUDOR y FIADOR, adicionar a mi deuda el valor del transporte en que se incurrió por esta novedad."],
                        ["title"=>"A9","description"=>"Autorizo al acreedor, EN CASO QUE YO REFERENCIE, RECOMIENDE a otra persona como cliente de su empresa ser FIADOR SOLIDARIO / CODEUDOR de esa nueva cuenta. Y en caso que se inicie a futuro algún proceso legal, los títulos valores firmados por mí, pueden tomarlo como garantía para ese proceso legal (si existiere)
                        El recomendar o ser recomendado por otra persona (cliente), me hace ser responsable, CODEUDOR o FIADOR SOLIDARIO de manera bilateral. O sea, yo sería CODEUDOR / FIADOR SOLIDARIO del referenciado y viceversa (el referenciado seria fiador mío)."],
                        ["title"=>"A10","description"=>"Autorizo al acreedor, EN CASO QUE ALGUIEN ME REFERENCIE, RECOMIENDE como cliente de su empresa ser FIADOR SOLIDARIO / CODEUDOR de esa cuenta del cliente que me recomendó a su empresa. Y en caso que se inicie a futuro algún proceso legal en contra de esa persona, los títulos valores firmados por mí, pueden tomarlo como garantía para ese proceso legal (si existiere)"],
                        ["title"=>"A11","description"=>"Autorizo al acreedor, quedarse con mi (s) titulo (s) valor (es) hasta que yo como DEUDOR o mi FIADOR SOLIDARIO BILATERAL o FIADOR CRUZADO haya (mos) pagado la totalidad de la deuda y estemos a PAZ y SALVO con el acreedor."],
                        ["title"=>"A12","description"=>"Autorizo al acreedor, EN CASO DE EMBARGO SALARIAL Y/O DE BIENES (si lo hubiere), un proceso legal por cada título valor firmado: Letras y/o PAGARE."],
                        ["title"=>"A13","description"=>"Confirmo y doy fé al acreedor, que antes de recomendar a una persona como futuro cliente de su empresa ya previamente he hablado con él (ella), y ha autorizado ser mi FIADOR SOLIDARIO / CODEUDOR de mi cuenta."],
                        ["title"=>"A14","description"=>"Autorizo pagar costos adicionales por concepto de transporte, en caso que haya que enviar a un cobrador por decision del ACREEDOR o por incumplimientos en los pagos o acuerdos y se necesite trasladar el cobrador hasta el lugar de trabajo o de residencia del deudor."],
                        ["title"=>"A15","description"=>"Autorizo ser fiador solidario cruzado aun en el caso que yo como deudor haya cancelado la totalidad de mi deuda y mi referenciado no haya pagado la totalidad de la cuenta. Los titulos valores me seran entregados cuando yo como deudor y mis referidos hayan cancelado la totalidad de la deuda."],
        ]);
        //
    }
}
