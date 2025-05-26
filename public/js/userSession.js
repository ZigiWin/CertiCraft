document.addEventListener('DOMContentLoaded', async () => {
    const userBox = document.getElementById('user-box');
    if (!userBox) return;

    const res = await fetch('/CertiCraft/get_user_info.php');
    const data = await res.json();

    if (data.auth) {
        userBox.innerHTML = `
            <img src="${data.avatar}" alt="Аватар" id="profile-avatar" style="width:40px; height:40px; border-radius:50%; cursor:pointer;">
        `;
        document.body.insertAdjacentHTML('beforeend', `
            <div id="profile-modal" class="modal" style="display:none; position:fixed; top:10%; left:50%; transform:translateX(-50%); background:#fff; padding:20px; border-radius:10px; box-shadow:0 0 10px rgba(0,0,0,0.3); z-index:1000;">
                <h3>${data.name}</h3>
                <p><a href="profile.php">Личный кабинет</a></p>
                <p><a href="logout.php">Выйти</a></p>
            </div>
        `);

        const modal = document.getElementById('profile-modal');
        document.getElementById('profile-avatar').onclick = () => {
            modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
        };

        window.addEventListener('click', e => {
            if (e.target !== modal && e.target.id !== 'profile-avatar') {
                modal.style.display = 'none';
            }
        });

    } else {
        userBox.innerHTML = `<a href="auth.php" class="login-btn">Войти</a>`;
    }
});
