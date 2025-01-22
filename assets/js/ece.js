function updateContact(_0x9abc, _0xd3f0, _0xk7nh, _0x6qw3 = 'href') {
    fetch(_0x9abc)
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            const decodedValue = window.atob(data.ec).replace(data.s, '');

            const element = document.getElementById(_0xd3f0);
            if (element && decodedValue) {
                if (_0x6qw3 === 'href') {
                    element.href = 'mailto:' + decodedValue;
                } else if (_0x6qw3 === 'innerHTML') {
                    element.innerHTML = `<a href="mailto:${decodedValue}">${decodedValue}</a>`;
                }
            }
        })
        .catch((error) => {
            console.error('Error ', error);

            const element = document.getElementById(_0xd3f0);
            if (element) {
                if (_0x6qw3 === 'href') {
                    element.href = _0xk7nh; // Fallback
                } else if (_0x6qw3 === 'innerHTML') {
                    element.innerText = 'Für diese Funktion ist JavaScript notwendig';
                }
            }
        });
}