const campoTelefone = document.querySelector('input[name="telefone"]');

if (campoTelefone) {
  const formatar = (valor) => {
    const d = valor.replace(/\D/g, "").slice(0, 11); // só dígitos, máximo 11

    if (d.length === 0) return "";
    if (d.length <= 2) return "(" + d;
    if (d.length <= 6) return "(" + d.slice(0, 2) + ") " + d.slice(2);
    if (d.length <= 10)
      return "(" + d.slice(0, 2) + ") " + d.slice(2, 6) + "-" + d.slice(6);
    return "(" + d.slice(0, 2) + ") " + d.slice(2, 7) + "-" + d.slice(7);
  };

  campoTelefone.addEventListener("input", () => {
    campoTelefone.value = formatar(campoTelefone.value);
  });

  campoTelefone.value = formatar(campoTelefone.value);
}
