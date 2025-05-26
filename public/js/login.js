const modal = document.getElementById("profileModal");
const avatar = document.getElementById("avatar");
const username = document.getElementById("username");
const source = document.getElementById("source");

const DEFAULT_AVATAR = "https://i.imgur.com/Ik3jACb.png";

function register(provider) {
    let name = "Пользователь";
    let avatarUrl = DEFAULT_AVATAR;
    let providerName = "";

    if (provider === "google") {
        name = "Иван Гуглов";
        avatarUrl = "https://i.pravatar.cc/150?img=3";
        providerName = "Google";
    } else if (provider === "vk") {
        name = "Алексей ВКонтакт";
        avatarUrl = "https://i.pravatar.cc/150?img=5";
        providerName = "VK";
    } else {
        name = "Пользователь";
        avatarUrl = DEFAULT_AVATAR;
        providerName = "Email";
    }

    // Устанавливаем данные в модалке
    username.textContent = name;
    avatar.src = avatarUrl;
    source.textContent = `Вход через: ${providerName}`;

    modal.style.display = "block";
}

function logout() {
    modal.style.display = "none";
    alert("Вы вышли из личного кабинета.");
}

// Закрытие при клике вне окна
window.onclick = function (event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}
