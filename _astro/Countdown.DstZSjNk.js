import { r as i } from "./index.DhYZZe0J.js";
var f = { exports: {} }, l = {};

/**
 * @license React
 * react-jsx-runtime.production.min.js
 *
 * Copyright (c) Facebook, Inc. and its affiliates.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

var x = i, m = Symbol.for("react.element"), u = Symbol.for("react.fragment"), 
    p = Object.prototype.hasOwnProperty, h = x.__SECRET_INTERNALS_DO_NOT_USE_OR_YOU_WILL_BE_FIRED.ReactCurrentOwner, 
    y = { key: !0, ref: !0, __self: !0, __source: !0 };

function d(a, e, o) {
    var t, r = {}, s = null, c = null;
    o !== void 0 && (s = "" + o), e.key !== void 0 && (s = "" + e.key), 
    e.ref !== void 0 && (c = e.ref);
    for (t in e) p.call(e, t) && !y.hasOwnProperty(t) && (r[t] = e[t]);
    if (a && a.defaultProps) for (t in e = a.defaultProps, e) r[t] === void 0 && (r[t] = e[t]);
    return { $$typeof: m, type: a, key: s, ref: c, props: r, _owner: h.current };
}

l.Fragment = u;
l.jsx = d;
l.jsxs = d;
f.exports = l;

var n = f.exports;

const v = () => {
    const fechaObjetivo = "2024-12-06T00:00:00"; // Fecha límite: 6 de diciembre

    // Función para calcular el tiempo restante
    const calcularTiempoRestante = () => {
        const ahora = new Date();
        const diferencia = new Date(fechaObjetivo) - ahora;

        return diferencia <= 0 ? null : {
            Días: Math.floor(diferencia / 864e5),
            Horas: Math.floor((diferencia / 36e5) % 24),
            Minutos: Math.floor((diferencia / 1e3 / 60) % 60),
            Segundos: Math.floor((diferencia / 1e3) % 60),
        };
    };

    // Estado inicial
    const [tiempoRestante, setTiempoRestante] = i.useState(calcularTiempoRestante());

    // Efecto para actualizar el estado cada segundo
    i.useEffect(() => {
        if (!tiempoRestante) return;

        const intervalo = setInterval(() => {
            setTiempoRestante(calcularTiempoRestante());
        }, 1000);

        return () => clearInterval(intervalo);
    }, [tiempoRestante]);

    // Renderizado
    return tiempoRestante
        ? n.jsxs("div", {
            className: "flex flex-col items-center justify-center py-10 bg-white shadow-md rounded-lg",
            children: [
                n.jsx("h2", {
                    className: "text-2xl font-semibold text-gray-700 mb-6",
                    children: "Tiempo restante para la rifa del viaje a Colombia",
                }),
                n.jsx("div", {
                    className: "flex gap-4",
                    children: Object.entries(tiempoRestante).map(([clave, valor]) =>
                        n.jsxs(
                            "div",
                            {
                                className: "flex flex-col items-center bg-gray-100 border border-gray-300 rounded-lg p-4 shadow-lg",
                                children: [
                                    n.jsx("span", {
                                        className: "text-4xl font-bold text-blue-600",
                                        children: valor,
                                    }),
                                    n.jsx("span", {
                                        className: "text-sm text-gray-500 capitalize",
                                        children: clave,
                                    }),
                                ],
                            },
                            clave
                        )
                    ),
                }),
            ],
        })
        : n.jsx("div", {
            className: "text-center text-xl font-semibold text-gray-800",
            children: "¡El sorteo ya ha iniciado!",
        });
};

export { v as default };
