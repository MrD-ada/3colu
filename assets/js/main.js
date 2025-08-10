/**
 * ハンバーガーメニューの制御
 */
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNavigation = document.querySelector('.main-navigation');
    
    if (menuToggle && mainNavigation) {
        // 初期状態でaria-expandedを設定
        menuToggle.setAttribute('aria-expanded', 'false');
        
        // クリックイベントを追加
        menuToggle.addEventListener('click', function() {
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            
            // aria-expandedの値を切り替え
            menuToggle.setAttribute('aria-expanded', !isExpanded);
            
            // メニューの表示/非表示をクラスで切り替え
            mainNavigation.classList.toggle('is-open', !isExpanded);
        });
        
        // ウィンドウサイズが変更された時の処理
        window.addEventListener('resize', function() {
            if (window.innerWidth > 900) {
                // PC表示の場合はメニューを表示し、状態をリセット
                mainNavigation.classList.remove('is-open');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
        
        // メニューリンクをクリックした時にメニューを閉じる（モバイル時のみ）
        const menuLinks = mainNavigation.querySelectorAll('a');
        menuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 900) {
                    mainNavigation.classList.remove('is-open');
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
            });
        });
    }
});

/**
 * 追尾広告の制御（既存の機能があれば）
 */
document.addEventListener('DOMContentLoaded', function() {
    const stickySidebars = document.querySelectorAll('.sticky-sidebar');
    
    if (stickySidebars.length > 0) {
        function toggleStickySidebars() {
            const windowWidth = window.innerWidth;
            
            stickySidebars.forEach(function(sidebar) {
                if (windowWidth >= 1200) {
                    sidebar.style.display = 'block';
                } else {
                    sidebar.style.display = 'none';
                }
            });
        }
        
        // 初期表示
        toggleStickySidebars();
        
        // ウィンドウリサイズ時
        window.addEventListener('resize', toggleStickySidebars);
    }
});

/**
 * スムーススクロール（オプション）
 */
document.addEventListener('DOMContentLoaded', function() {
    // ページ内リンクのスムーススクロール
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            const target = document.querySelector(href);
            
            if (target && href !== '#') {
                e.preventDefault();
                
                const headerHeight = document.querySelector('.site-header').offsetHeight;
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
});