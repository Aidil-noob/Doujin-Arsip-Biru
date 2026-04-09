fetch('data.json')
  .then(res => res.json())
  .then(data => {
    const container = document.getElementById("list");

    data.forEach(item => {
      container.innerHTML += `
        <div class="card" onclick="goDetail(${item.id})">
          <div class="tag">Doujinshi</div>
          <img src="${item.sampul}">
          <div class="title">${item.judul}</div>
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