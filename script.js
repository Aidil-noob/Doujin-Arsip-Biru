fetch('data.json')
  .then(res => res.json())
  .then(data => {
    const container = document.getElementById("list");
    document.title = item.judul;

    data.forEach(item => {
      container.innerHTML += `
        <div class="card" onclick="goDetail(${item.id})">
            <img src="${item.sampul}">
            <div class="judul">${item.judul}</div>
            <div class="bahasa">Bahasa : ${item.bahasa}</div>
            <div class="halaman">${item.halaman.length} halaman</div>
        </div>
      `;
    });

    // simpan ke localStorage biar bisa dipakai di halaman detail
    localStorage.setItem("doujinData", JSON.stringify(data));
  });

function goDetail(id) {
  localStorage.setItem("selectedId", id);
  window.location.href = "detail.html";
}