import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import { onMounted, reactive } from "vue";
import { usePage } from "@inertiajs/vue3";

const oPapelTrabajo = reactive({
    id: 0,
    trabajo_auditoria_id: "",
    papel_detalles1: reactive([
        {
            id: 0,
            nro_etapa: 1,
            nombre: "Memorándum de Planificación de Auditoría referenciado a los documentos de respaldo",
            nro_nombre: 1,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 1,
            nombre: "Programas de Trabajo",
            nro_nombre: 2,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 1,
            nombre: "Documentación de respaldo del memorándum de planificación de auditoría",
            nro_nombre: 3,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 1,
            nombre: "Matriz de hallazgos de auditoría y documentación sustentatoria de los mismos",
            nro_nombre: 4,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 1,
            nombre: "Detalle de funcionarios de la entidad auditada relacionados con las operaciones sujetas al examen",
            nro_nombre: 5,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 1,
            nombre: "Correspondencia recibida y expedida",
            nro_nombre: 6,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 1,
            nombre: "Planilla de pendientes",
            nro_nombre: 7,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
    ]),
    papel_detalles2: reactive([
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Formulario de inspección de la Subcontraloría de auditoría",
            nro_nombre: 1,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Informe preliminar de auditoría con indicios de responsabilidad por la función pública, referenciado al Legajo de Prueba y Papeles de Trabajo",
            nro_nombre: 2,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Informe circunstanciado de hechos, referenciado al legajo de prueba de papeles de trabajo",
            nro_nombre: 3,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Informe con pronunciamiento, referenciado a los papeles de trabajo",
            nro_nombre: 4,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Informe sin indicios de responsabilidad con recomendaciones de control interno, referenciado a Papeles de Trabajo",
            nro_nombre: 5,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Nota administrativa, referenciado al legajo de prueba y legajo de papeles de trabajo",
            nro_nombre: 6,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Acta de compatibilización de los informes de auditoría y legal",
            nro_nombre: 7,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Informe legal de la Gerencia de Servicios Legales o Subcontraloría de Servicios Legales",
            nro_nombre: 8,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Formulario de Inspección de la Subcontraloría de servicios Legales",
            nro_nombre: 9,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Informe de evaluación técnica/opinión técnica y otros, referenciado a los papeles de trabajo, adjuntando el documento de inspección técnica",
            nro_nombre: 10,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Confirmación de la entidad sobre la documentación proporcionada a la comisión de auditoría",
            nro_nombre: 11,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Cédula y formularios de reuniones sostenidas con los funcionarios de la entidad",
            nro_nombre: 12,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Cédula de sugerencias para futuros exámenes",
            nro_nombre: 13,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Acta de entrega y devolución de documentos",
            nro_nombre: 14,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Formulario F-1 y F1-A, éste último si corresponde",
            nro_nombre: 15,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
        {
            id: 0,
            nro_etapa: 2,
            nombre: "Planilla de control de horas asignadas",
            nro_nombre: 16,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
    ]),
    papel_detalles3: reactive([
        {
            id: 0,
            nro_etapa: 3,
            nombre: "",
            nro_nombre: 0,
            aplicabilidad: "SI",
            estado: "NO INICIADO",
            papel_archivos: [],
            eliminados: [],
        },
    ]),
    eliminados_detalles: reactive([]),
    _method: "POST",
});

export const usePapelTrabajos = () => {
    const { flash } = usePage().props;
    const getPapelTrabajos = async (data) => {
        try {
            const response = await axios.get(route("papel_trabajos.listado"), {
                headers: { Accept: "application/json" },
                params: data,
            });
            return response.data.papel_trabajos;
        } catch (err) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: `${
                    flash.error
                        ? flash.error
                        : err.response?.data
                        ? err.response?.data?.message
                        : "Hay errores en el formulario"
                }`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
            throw err; // Puedes manejar el error según tus necesidades
        }
    };

    const getPapelTrabajosApi = async (data) => {
        try {
            const response = await axios.get(
                route("papel_trabajos.paginado", data),
                {
                    headers: { Accept: "application/json" },
                }
            );
            return response.data.papel_trabajos;
        } catch (err) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: `${
                    flash.error
                        ? flash.error
                        : err.response?.data
                        ? err.response?.data?.message
                        : "Hay errores en el formulario"
                }`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
            throw err; // Puedes manejar el error según tus necesidades
        }
    };
    const savePapelTrabajo = async (data) => {
        try {
            const response = await axios.post(
                route("papel_trabajos.store", data),
                {
                    headers: { Accept: "application/json" },
                }
            );
            Swal.fire({
                icon: "success",
                title: "Correcto",
                text: `${flash.bien ? flash.bien : "Proceso realizado"}`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
            return response.data;
        } catch (err) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: `${
                    flash.error
                        ? flash.error
                        : err.response?.data
                        ? err.response?.data?.message
                        : "Hay errores en el formulario"
                }`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
            throw err; // Puedes manejar el error según tus necesidades
        }
    };

    const deletePapelTrabajo = async (id) => {
        try {
            const response = await axios.delete(
                route("papel_trabajos.destroy", id),
                {
                    headers: { Accept: "application/json" },
                }
            );
            Swal.fire({
                icon: "success",
                title: "Correcto",
                text: `${flash.bien ? flash.bien : "Proceso realizado"}`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
            return response.data;
        } catch (err) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: `${
                    flash.error
                        ? flash.error
                        : err.response?.data
                        ? err.response?.data?.message
                        : "Hay errores en el formulario"
                }`,
                confirmButtonColor: "#3085d6",
                confirmButtonText: `Aceptar`,
            });
            throw err; // Puedes manejar el error según tus necesidades
        }
    };

    const setPapelTrabajo = (item = null) => {
        if (item) {
            oPapelTrabajo.id = item.id;
            oPapelTrabajo.trabajo_auditoria_id = item.trabajo_auditoria_id;
            oPapelTrabajo.papel_detalles1 = reactive([
                ...item.papel_detalles.filter((elem) => elem.nro_etapa == 1),
            ]);
            oPapelTrabajo.papel_detalles2 = reactive([
                ...item.papel_detalles.filter((elem) => elem.nro_etapa == 2),
            ]);
            oPapelTrabajo.papel_detalles3 = reactive([
                ...item.papel_detalles.filter((elem) => elem.nro_etapa == 3),
            ]);
            oPapelTrabajo.eliminados_detalles = reactive([]);
            oPapelTrabajo._method = "PUT";
            return oPapelTrabajo;
        }
        return false;
    };

    const limpiarPapelTrabajo = () => {
        oPapelTrabajo.id = 0;
        oPapelTrabajo.trabajo_auditoria_id = "";
        oPapelTrabajo.papel_detalles1 = reactive([
            {
                id: 0,
                nro_etapa: 1,
                nombre: "Memorándum de Planificación de Auditoría referenciado a los documentos de respaldo",
                nro_nombre: 1,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 1,
                nombre: "Programas de Trabajo",
                nro_nombre: 2,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 1,
                nombre: "Documentación de respaldo del memorándum de planificación de auditoría",
                nro_nombre: 3,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 1,
                nombre: "Matriz de hallazgos de auditoría y documentación sustentatoria de los mismos",
                nro_nombre: 4,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 1,
                nombre: "Detalle de funcionarios de la entidad auditada relacionados con las operaciones sujetas al examen",
                nro_nombre: 5,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 1,
                nombre: "Correspondencia recibida y expedida",
                nro_nombre: 6,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 1,
                nombre: "Planilla de pendientes",
                nro_nombre: 7,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
        ]);
        oPapelTrabajo.papel_detalles2 = reactive([
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Formulario de inspección de la Subcontraloría de auditoría",
                nro_nombre: 1,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Informe preliminar de auditoría con indicios de responsabilidad por la función pública, referenciado al Legajo de Prueba y Papeles de Trabajo",
                nro_nombre: 2,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Informe circunstanciado de hechos, referenciado al legajo de prueba de papeles de trabajo",
                nro_nombre: 3,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Informe con pronunciamiento, referenciado a los papeles de trabajo",
                nro_nombre: 4,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Informe sin indicios de responsabilidad con recomendaciones de control interno, referenciado a Papeles de Trabajo",
                nro_nombre: 5,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Nota administrativa, referenciado al legajo de prueba y legajo de papeles de trabajo",
                nro_nombre: 6,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Acta de compatibilización de los informes de auditoría y legal",
                nro_nombre: 7,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Informe legal de la Gerencia de Servicios Legales o Subcontraloría de Servicios Legales",
                nro_nombre: 8,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Formulario de Inspección de la Subcontraloría de servicios Legales",
                nro_nombre: 9,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Informe de evaluación técnica/opinión técnica y otros, referenciado a los papeles de trabajo, adjuntando el documento de inspección técnica",
                nro_nombre: 10,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Confirmación de la entidad sobre la documentación proporcionada a la comisión de auditoría",
                nro_nombre: 11,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Cédula y formularios de reuniones sostenidas con los funcionarios de la entidad",
                nro_nombre: 12,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Cédula de sugerencias para futuros exámenes",
                nro_nombre: 13,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Acta de entrega y devolución de documentos",
                nro_nombre: 14,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Formulario F-1 y F1-A, éste último si corresponde",
                nro_nombre: 15,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
            {
                id: 0,
                nro_etapa: 2,
                nombre: "Planilla de control de horas asignadas",
                nro_nombre: 16,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
        ]);
        oPapelTrabajo.papel_detalles3 = reactive([
            {
                id: 0,
                nro_etapa: 3,
                nombre: "",
                nro_nombre: 0,
                aplicabilidad: "SI",
                estado: "NO INICIADO",
                papel_archivos: [],
                eliminados: [],
            },
        ]);
        oPapelTrabajo.eliminados_detalles = reactive([]);
        oPapelTrabajo._method = "POST";
    };

    onMounted(() => {});

    return {
        oPapelTrabajo,
        getPapelTrabajos,
        getPapelTrabajosApi,
        savePapelTrabajo,
        deletePapelTrabajo,
        setPapelTrabajo,
        limpiarPapelTrabajo,
    };
};
