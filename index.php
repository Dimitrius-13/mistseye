<?php require_once( 'couch/cms.php' ); ?>
<cms:template title='Головна сторінка'>
    <cms:editable name='group_contacts' label='Контакти та Соцмережі' type='group' />
    <cms:editable name='group_gallery' label='Галерея' type='group' />
    <cms:editable name='group_prices' label='Ціни (Калькулятор)' type='group' />
    <cms:editable name='group_docs' label='Документи' type='group' />
</cms:template>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>МісцеЄ | Міні-склади у Вінниці</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Raleway:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            --primary: #76b041;        
            --primary-dark: #4a7c2a;   
            --accent-yellow: #FFC107; 
            --border-yellow: #d4a006; 
            --accent-gray: #C3C3C3;
            --border-gray: #888888;    
            --text: #2d3436;
            --white: #ffffff;
            --gray: #636e72;
            --bg-light: #f1f8e9;

            /* --- РОЗМІРИ СОТ (Десктоп) --- */
            --hex-w: 130px;
            --hex-h: 150px;        
            --hex-gap: 6px;        
            --row-overlap: -36px;  
            --shift-amount: 68px;  
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Montserrat', sans-serif; color: var(--text); background-color: var(--bg-light); line-height: 1.6; }
        a { text-decoration: none; color: inherit; transition: 0.3s; }
        img { max-width: 100%; display: block; }

        /* HEADER */
        header { background: var(--white); padding: 15px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 4px 15px rgba(118, 176, 65, 0.15); }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .header-wrap { display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 28px; font-weight: 800; color: var(--primary-dark); letter-spacing: -1px; }
        .logo span { color: var(--primary); }
        .header-contacts { display: flex; gap: 20px; align-items: center; }
        .phones { display: flex; flex-direction: column; text-align: right; font-weight: 700; font-size: 14px; }
        .phones a:hover { color: var(--primary); }
        
        .social-icons-header { display: flex; gap: 10px; }
        .social-icons-header a { display: flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #eee; border-radius: 50%; color: var(--text); transition: 0.3s; }
        .social-icons-header a:hover { background: var(--primary); color: white; }

        /* HERO */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover; background-position: center; padding: 100px 0; color: white; text-align: center;
        }
        .hero h1 { font-size: 38px; margin-bottom: 20px; font-weight: 800; line-height: 1.2; text-transform: uppercase; }
        .hero-btns { display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; }
        .btn-hero { background: var(--primary); color: white; padding: 15px 40px; border-radius: 50px; font-size: 18px; font-weight: 700; box-shadow: 0 10px 20px rgba(0,0,0,0.2); cursor: pointer; border: none; }
        .btn-hero:hover { background: var(--primary-dark); transform: scale(1.05); }

        /* INTRO TEXT */
        .intro-text-section { padding: 50px 0 30px; background: var(--bg-light); text-align: center; }
        .intro-text-content { max-width: 800px; margin: 0 auto; font-size: 18px; color: var(--text); }
        .highlight-text { font-weight: 800; color: var(--primary-dark); display: block; margin-top: 10px; font-size: 20px; }

        /* --- HONEYCOMB --- */
        .honeycomb-section { padding: 60px 0; }
        .section-title { font-size: 32px; color: var(--text); margin-bottom: 40px; font-weight: 800; text-transform: uppercase; text-align: center; }
        
        .hex-grid-container { display: flex; flex-direction: column; align-items: center; padding-bottom: 30px; }
        .hex-row { display: flex; justify-content: center; gap: var(--hex-gap); margin-top: var(--row-overlap); position: relative; z-index: 1; }
        .hex-row:first-child { margin-top: 0; z-index: 10; }
        .hex-row:nth-child(2) { z-index: 9; }
        .hex-row:nth-child(3) { z-index: 8; }
        .offset-left { transform: translateX(calc(var(--shift-amount) * -1)); }
        .offset-right { transform: translateX(calc(var(--shift-amount) / 1)); }
        
        .hex-wrapper { width: var(--hex-w); height: var(--hex-h); filter: drop-shadow(0 4px 3px rgba(0,0,0,0.15)); transition: transform 0.2s; }
        .hex-wrapper:hover { transform: scale(1.05); z-index: 50; }
        .hex-border { width: 100%; height: 100%; clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); background-color: #333; display: flex; align-items: center; justify-content: center; }
        .hex-inner { width: calc(100% - 4px); height: calc(100% - 4px); clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); background-color: #fff; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 0 5px; gap: 5px; }
        .hex-inner i, .hex-inner svg { width: 32px; height: 32px; stroke-width: 1.5; margin-bottom: 5px; }
        .hex-inner h4 { margin: 0; font-size: 11px; font-weight: 800; text-transform: uppercase; line-height: 1.1; color: #2d3436; max-width: 90%; }
        
        .type-yellow .hex-border { background-color: var(--border-yellow); }
        .type-yellow .hex-inner { background-color: var(--accent-yellow); }
        .type-yellow:hover .hex-inner { background-color: #ffd54f; }
        
        .type-gray .hex-border { background-color: var(--border-gray); }
        .type-gray .hex-inner { background-color: var(--accent-gray); }
        .type-gray .hex-inner h4 { color: white; }
        .type-gray .hex-inner i, .type-gray .hex-inner svg { stroke: white; }
        
        .rules-wrapper { display: flex; flex-wrap: wrap; justify-content: center; gap: 40px; align-items: flex-start; }
        .rules-column { flex: 1; min-width: 320px; display: flex; flex-direction: column; align-items: center; }

        /* CALCULATOR */
        .calculator { background: white; padding: 60px 0; border-radius: 30px 30px 0 0; margin-top: -30px; position: relative; z-index: 10; }
        .section-desc { text-align: center; margin-bottom: 30px; color: var(--gray); max-width: 700px; margin-left: auto; margin-right: auto; }
        
        .vehicle-wrap { display: flex; justify-content: center; gap: 20px; margin-bottom: 30px; flex-wrap: wrap; }
        .vehicle-btn { border: 2px solid #eee; background: white; padding: 20px; border-radius: 15px; cursor: pointer; text-align: center; min-width: 150px; transition: 0.2s; }
        .vehicle-btn img { width: 64px; height: 40px; margin: 0 auto 10px; object-fit: contain; }
        .vehicle-btn.active { border-color: var(--primary); background: var(--bg-light); transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .v-title { font-weight: 700; display: block; }
        .v-subtitle { font-size: 12px; color: var(--gray); }

        .calc-grid { display: grid; grid-template-columns: 1.3fr 0.7fr; gap: 40px; max-width: 1100px; margin: 0 auto; }
        .left-col { display: flex; flex-direction: column; }
        
        .sizes-wrap { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 20px; }
        .size-btn { padding: 10px 5px; border: 2px solid #eee; background: white; border-radius: 10px; cursor: pointer; text-align: center; transition: 0.2s; display: flex; flex-direction: column; justify-content: center; align-items: center; height: 90px; }
        .size-btn.active { background: var(--primary); color: white; border-color: var(--primary); box-shadow: 0 4px 10px rgba(118, 176, 65, 0.4); transform: scale(1.02); z-index: 2; }
        .size-btn.disabled { opacity: 0.4; cursor: not-allowed; background: #f9f9f9; pointer-events: none; }
        .size-val { font-size: 16px; font-weight: 800; line-height: 1.2; }
        .size-price { font-size: 13px; font-weight: 600; margin-top: 5px; }

        .term-selector { display: flex; gap: 10px; margin-bottom: 25px; background: #f9f9f9; padding: 5px; border-radius: 15px; flex-wrap: wrap; justify-content: center; }
        .term-btn { flex: 1; min-width: 80px; border: none; background: transparent; padding: 10px 5px; border-radius: 10px; font-weight: 700; color: var(--gray); cursor: pointer; transition: 0.3s; font-size: 12px; position: relative; }
        .term-btn:hover { background: #eee; }
        .term-btn.active { background: white; color: var(--primary-dark); box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .term-btn.promo-btn { color: #d63031; }
        .term-btn.promo-btn.active { color: #d63031; background: #fff0f0; }

        /* GALLERY */
        .gallery-section { padding: 40px 0; overflow: hidden; }
        .gallery-wrapper { display: flex; gap: 20px; overflow-x: auto; scroll-snap-type: x mandatory; padding-bottom: 20px; -webkit-overflow-scrolling: touch; }
        .gallery-item { min-width: 300px; height: 300px; flex-shrink: 0; scroll-snap-align: center; border-radius: 10px; overflow: hidden; }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; }
        .gallery-item:hover img { transform: scale(1.05); }
        .gallery-wrapper::-webkit-scrollbar { height: 8px; }
        .gallery-wrapper::-webkit-scrollbar-thumb { background: #ccc; border-radius: 4px; }

        .calc-result-bar { background: #f1f8e9; border: 2px solid #c8e6c9; padding: 20px 30px; border-radius: 15px; display: flex; flex-direction: column; position: relative; }
        .discount-badge { background: #E1306C; color: white; padding: 5px 15px; border-radius: 20px; font-weight: 700; font-size: 14px; text-transform: uppercase; align-self: center; margin-bottom: 15px; box-shadow: 0 4px 10px rgba(225, 48, 108, 0.3); animation: pulse 2s infinite; }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }
        
        .result-content { display: flex; align-items: center; justify-content: space-between; width: 100%; }
        .result-title { font-weight: 800; font-size: 22px; color: var(--primary-dark); margin: 0; line-height: 1.2; }
        .result-price-block { margin-top: 5px; }
        .old-price { font-size: 14px; text-decoration: line-through; color: #999; margin-right: 5px; font-weight: 600; }
        .result-price { font-size: 40px; font-weight: 800; color: var(--primary); line-height: 1; }
        .total-sum { font-size: 13px; color: var(--text); background: rgba(255,255,255,0.6); padding: 4px 10px; border-radius: 5px; margin-top: 5px; display: inline-block; font-weight: 600; }

        .result-actions { display: flex; gap: 10px; }
        .btn-green { background: var(--primary); color: white; border: none; padding: 15px 30px; border-radius: 30px; font-weight: 700; cursor: pointer; text-transform: uppercase; font-size: 14px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: 0.2s; }
        .btn-green:hover { background: var(--primary-dark); transform: translateY(-2px); }
        .btn-dark { background: #2d3436; color: white; border: none; padding: 15px 30px; border-radius: 30px; font-weight: 700; cursor: pointer; text-transform: uppercase; font-size: 14px; transition: 0.2s; }
        .btn-dark:hover { background: #000; transform: translateY(-2px); }

        .visualizer { background: #fafafa; border-radius: 20px; overflow: hidden; height: 100%; min-height: 400px; position: relative; display: flex; align-items: center; justify-content: center; border: 1px solid #eee; }
        .visualizer img { width: 100%; height: 100%; object-fit: contain; }
        .size-badge { position: absolute; top: 20px; right: 20px; background: var(--primary); color: white; padding: 5px 15px; border-radius: 20px; font-weight: 700; font-size: 18px; z-index: 10; }

        /* LOCATION */
        .location-section { padding: 60px 0; background-color: var(--bg-light); }
        .maps-row { display: flex; gap: 30px; justify-content: center; margin-top: 40px; flex-wrap: wrap; }
        .map-frame { flex: 1; min-width: 300px;  background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border: 2px solid #fff; }
        .map-frame img { width: 100%; height: 100%; object-fit: cover; }
        .scheme-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #f8f9fa; color: #aaa; flex-direction: column; }

        footer { background: #2d3436; color: white; padding: 50px 0; text-align: center; margin-top: 0; }
        .socials { display: flex; justify-content: center; gap: 15px; margin-top: 20px; }
        .social-link { width: 40px; height: 40px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .social-link:hover { background: var(--primary); }

        /* --- MODAL WINDOW --- */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.6);
            z-index: 9999;
            align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.3s;
        }
        .modal-overlay.active { display: flex; opacity: 1; }
        .modal-content {
            background: #fff;
            width: 90%; max-width: 500px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            transform: translateY(20px); transition: transform 0.3s;
            /* Фірмовий патерн */
            background-image: radial-gradient(#76b041 1px, transparent 1px);
            background-size: 20px 20px;
            background-color: #ffffff;
            border: 4px solid var(--primary);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }
        .modal-overlay.active .modal-content { transform: translateY(0); }
        .modal-header {
            background: var(--primary);
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }
        .modal-header h3 { font-size: 22px; font-weight: 800; text-transform: uppercase; margin: 0; }
        .modal-header p { font-size: 14px; opacity: 0.9; margin-top: 5px; font-weight: 500; }
        .close-modal {
            position: absolute; top: 15px; right: 20px;
            color: white; font-size: 30px; cursor: pointer; line-height: 0.8;
            transition: 0.2s;
        }
        .close-modal:hover { transform: scale(1.1); }
        .modal-body {
            padding: 30px;
            background: white;
        }
        .form-group { margin-bottom: 20px; }
        .form-input {
            width: 100%;
            padding: 15px;
            border: 2px solid #eee;
            border-radius: 10px;
            font-size: 16px;
            font-family: 'Montserrat', sans-serif;
            transition: 0.3s;
        }
        .form-input:focus { border-color: var(--primary); outline: none; background: #f9fff5; }
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: #2d3436;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 18px; font-weight: 800; text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-submit:hover { background: #000; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        
        .selected-box-display {
            background: var(--bg-light);
            color: var(--primary-dark);
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            font-weight: 700;
            margin-bottom: 20px;
            border: 1px dashed var(--primary);
        }

        /* TABLET & MOBILE FIXES */
        @media (max-width: 900px) {
            .calc-grid { grid-template-columns: 1fr; }
            .visualizer { height: 300px; min-height: 300px; order: -1; margin-bottom: 20px; } 
            .calc-result-bar { text-align: center; gap: 10px; }
            .result-content { flex-direction: column; gap: 20px; }
            .result-actions { width: 100%; justify-content: center; flex-direction: column; }
            .header-contacts { flex-direction: column; gap: 10px; }
            .phones { text-align: center; }
        }
        @media (max-width: 600px) {
            :root { --hex-w: 135px; --hex-h: 155px; }
            .offset-right, .offset-left, .push-right { transform: none !important; margin: 0 !important; }
            .hex-row { display: flex; flex-wrap: wrap; justify-content: center; gap: 10px; margin: 0 !important; width: 100%; z-index: 1 !important; }
            .hex-wrapper, .hex-wrapper:nth-child(even), .hex-wrapper:nth-child(odd) { margin: 0 !important; transform: none !important; }
            .hex-grid-container { width: 100%; padding: 0; display: flex; flex-direction: column; align-items: center; }
            .hex-inner h4 { font-size: 11px; white-space: normal; line-height: 1.3; max-width: 95%; }
            .hex-inner i, .hex-inner svg { width: 28px; height: 28px; margin-bottom: 5px; }
            .hero h1 { font-size: 26px; }
            .gallery-item { min-width: 260px; height: 260px; }
            .term-selector { flex-wrap: wrap; }
            .term-btn { min-width: 45%; margin-bottom: 5px; }
            .sizes-wrap { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>

    <header>
        <div class="container header-wrap">
            <div class="logo">Місце<span>Є</span></div>
            <div class="header-contacts">
                <div class="phones">
                    <a href="tel:<cms:editable name='phone_num_1' group='group_contacts' type='text'>0985110505</cms:editable>">
                        <cms:editable name='phone_text_1' group='group_contacts' type='text'>098 511 05 05</cms:editable>
                    </a>
                    <a href="tel:<cms:editable name='phone_num_2' group='group_contacts' type='text'>0995110505</cms:editable>">
                        <cms:editable name='phone_text_2' group='group_contacts' type='text'>099 511 05 05</cms:editable>
                    </a>
                </div>
                <div class="social-icons-header">
                    <a href="<cms:editable name='link_instagram' group='group_contacts' type='text'>https://www.instagram.com/mistseye/</cms:editable>" title="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>
                    <a href="<cms:editable name='link_tiktok' group='group_contacts' type='text'>https://www.tiktok.com/@mistseye</cms:editable>" title="TikTok">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path></svg>
                    </a>
                </div>
                <div style="font-size: 12px; font-weight: 600; color: var(--gray);">
                    <i data-lucide="map-pin" style="width: 14px; vertical-align: middle;"></i> Вінниця, вул. Академіка Янгеля, 4
                </div>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1><cms:editable name='hero_title' type='text'>МІНІ СКЛАДИ ДЛЯ ВАШИХ РЕЧЕЙ</cms:editable></h1>
            <p style="font-weight: 700; color: var(--primary); background: white; display: inline-block; padding: 5px 15px; border-radius: 20px; margin-bottom: 20px;">
                <cms:editable name='hero_subtitle' type='text'>Доступні бокси розміром від 1 м³</cms:editable>
            </p>
            <div class="hero-btns">
                <button class="btn-hero" onclick="document.getElementById('calculator').scrollIntoView({behavior: 'smooth'})">Розрахувати вартість</button>
            </div>
        </div>
    </section>

    <section class="gallery-section">
      <div class="container">
        <div class="gallery-wrapper">
          <div class="gallery-item"><img src="<cms:editable name='gal_img_1' group='group_gallery' type='image'>images/image_f39db1.jpg</cms:editable>" alt="Коридор складу"></div>
          <div class="gallery-item"><img src="<cms:editable name='gal_img_2' group='group_gallery' type='image'>images/image_f3a224.jpg</cms:editable>" alt="Бокс зберігання"></div>
          <div class="gallery-item"><img src="<cms:editable name='gal_img_3' group='group_gallery' type='image'>images/image_f39dcf.jpg</cms:editable>" alt="Ліфт"></div>
          <div class="gallery-item"><img src="<cms:editable name='gal_img_4' group='group_gallery' type='image'>images/image_f3a1e7.jpg</cms:editable>" alt="Бокс зсередини"></div>
        </div>
      </div>
    </section>

    <section class="intro-text-section">
        <div class="container">
            <div class="intro-text-content">
                <p>Вам необхідно звільнити підвал, горище чи балкон від речей, якими рідко користуєтеся? Ми вирішимо ваші проблеми.</p>
                <span class="highlight-text">Звільніть дім для життя, а речі довірте нам.</span>
            </div>
        </div>
    </section>

    <section class="honeycomb-section">
        <div class="container">
            <h2 class="section-title">Чому обирають нас</h2>
            <div class="hex-grid-container">
                <div class="hex-row type-yellow">
                    <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="shield"></i><h4>Власна<br>охорона</h4></div></div></div>
                    <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="user-check"></i><h4>Доброзичливий<br>персонал</h4></div></div></div>
                    <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="arrow-up-from-line"></i><h4>Візки та<br>рампа</h4></div></div></div>
                    <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="map-pin"></i><h4>Зручне<br>розташування</h4></div></div></div>
                </div>
                <div class="hex-row type-yellow">
                    <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="layout-grid"></i><h4>Ефективний<br>простір</h4></div></div></div>
                    <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="video"></i><h4>Відеонагляд</h4></div></div></div>
                    <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="truck"></i><h4>Спецтехніка</h4></div></div></div>
                </div>
                <div class="hex-row type-yellow offset-left">
                    <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="tag"></i><h4>Знижки</h4></div></div></div>
                    <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="door-open"></i><h4>Легкий<br>доступ</h4></div></div></div>
                    <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="parking-circle"></i><h4>Парковка</h4></div></div></div>
                </div>
            </div>
        </div>
    </section>

    <section class="honeycomb-section" style="background: #fff;">
       <div class="container">
            <div class="rules-wrapper">
                <div class="rules-column">
                    <h2 class="section-title" style="color: var(--primary);">ДОЗВОЛЕНО</h2>
                    <div class="hex-grid-container">
                        <div class="hex-row type-yellow">
                            <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="washing-machine"></i><h4>Техніка</h4></div></div></div>
                            <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="shirt"></i><h4>Одяг</h4></div></div></div>
                            <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="disc"></i><h4>Шини</h4></div></div></div>
                        </div>
                        <div class="hex-row type-yellow offset-right">
                            <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="armchair"></i><h4>Меблі</h4></div></div></div>
                            <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="trophy"></i><h4>Спорт.<br>інвентар</h4></div></div></div>
                            <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="monitor"></i><h4>Офісна<br>техніка</h4></div></div></div>
                        </div>
                    </div>
                </div>
                <div class="rules-column">
                    <h2 class="section-title" style="color: #d63031;">ЗАБОРОНЕНО</h2>
                    <div class="hex-grid-container">
                        <div class="hex-row type-gray">
                            <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="utensils"></i><h4>Продукти</h4></div></div></div>
                            <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="sprout"></i><h4>Рослини</h4></div></div></div>
                            <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="paw-print"></i><h4>Тварини</h4></div></div></div>
                        </div>
                        <div class="hex-row type-gray">
                            <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="shield-ban"></i><h4>Зброя</h4></div></div></div>
                            <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="flame"></i><h4>Балони</h4></div></div></div>
                            <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="fuel"></i><h4>Паливо</h4></div></div></div>
                            <div class="hex-wrapper"><div class="hex-border"><div class="hex-inner"><i data-lucide="wind"></i><h4>Запахи</h4></div></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="calculator" id="calculator">
        <div class="container">
            <h2 class="section-title">Оберіть бокс ідеального розміру</h2>
            <p class="section-desc">Виберіть автомобіль для перевезення речей — і система миттєво підбере бокс відповідного розміру.</p>

            <div class="vehicle-wrap">
                <div class="vehicle-btn" onclick="setCar('sedan')">
                    <img src="https://api.iconify.design/mdi:car-side.svg?color=%23333" alt="Легковик">
                    <span class="v-title">Легковик</span>
                    <span class="v-subtitle">~1.5 м³</span>
                </div>
                <div class="vehicle-btn" onclick="setCar('pickup')">
                    <img src="https://api.iconify.design/mdi:car-pickup.svg?color=%23333" alt="Пікап">
                    <span class="v-title">Пікап</span>
                    <span class="v-subtitle">~3 м²</span>
                </div>
                <div class="vehicle-btn" onclick="setCar('van')">
                    <img src="https://api.iconify.design/mdi:van-utility.svg?color=%23333" alt="Бус">
                    <span class="v-title">Бус</span>
                    <span class="v-subtitle">~6 м²</span>
                </div>
            </div>

            <div class="calc-grid">
                <div class="left-col">
                    <h3 style="margin-bottom: 5px; font-size: 14px; text-transform: uppercase; color: var(--gray);">Доступні розміри:</h3>
                    <div class="sizes-wrap" id="sizesContainer"></div>
                    <div style="text-align: center; margin-bottom: 10px; font-weight: 600; color: var(--gray);">Термін оренди:</div>
                    <div class="term-selector">
                        <button class="term-btn active" onclick="setDuration(1)">1 міс</button>
                        <button class="term-btn" onclick="setDuration(3)">3 міс</button>
                        <button class="term-btn" onclick="setDuration(6)">6 міс</button>
                        <button class="term-btn" onclick="setDuration(12)">12 міс (-5%)</button>
                        <button class="term-btn promo-btn" onclick="setDuration(15)">15+ міс (-7%)</button>
                    </div>

                    <div class="calc-result-bar">
                        <div id="promoBadge" class="discount-badge" style="display: none;">Акція активована! (-7%)</div>
                        <div class="result-content">
                            <div class="result-left">
                                <h3 id="resultTitle" class="result-title">Бокс 1.5 м³</h3>
                                <div class="result-price-block">
                                    <span id="oldPrice" class="old-price" style="display:none;">750</span>
                                    <span id="resultPrice" class="result-price">675</span>
                                    <span class="result-price" style="font-size: 24px;">грн</span>
                                    <span style="font-size: 12px; color: #666; display: block;">за місяць</span>
                                    <span id="totalSum" class="total-sum">Разом: 675 грн</span>
                                </div>
                            </div>
                            <div class="result-actions">
                                <button class="btn-green" onclick="openModal('booking')">ЗАБРОНЮВАТИ</button>
                                <button class="btn-dark" onclick="openModal('excursion')">ЕКСКУРСІЯ</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="visualizer">
                    <div class="size-badge" id="visualBadge">1.5 м³</div>
                    <img id="visualImage" src="" alt="Візуалізація" onerror="this.style.display='none'; this.parentNode.innerHTML='<div style=\'padding:20px;text-align:center\'>Зображення не знайдено.<br>Перевірте папку images</div>'">
                </div>
            </div>
        </div>
    </section>

    <section class="location-section">
        <div class="container">
            <h2 class="section-title">Як нас знайти</h2>
            <div style="text-align: center; font-size: 18px; font-weight: 700; margin-bottom: 10px;">
                м. Вінниця, вул. Академіка Янгеля, 4
            </div>
            <div class="maps-row">
                <div class="map-frame">
                    <iframe src="https://maps.google.com/maps?q=Вінниця,%20вул.%20Фрунзе%204&t=&z=15&ie=UTF8&iwloc=&output=embed" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen></iframe>
                </div>
                <div class="map-frame">
                    <img src="<cms:editable name='scheme_img' group='group_gallery' type='image'>images/schema.jpg</cms:editable>" alt="Схема проїзду">
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="logo" style="color: white; margin-bottom: 20px;">Місце<span>Є</span></div>
            <p style="margin-bottom: 15px;">м. Вінниця, вул. Академіка Янгеля, 4</p>
            
            <a href="<cms:editable name='oferta_file' group='group_docs' type='file'>docs/offerta.pdf</cms:editable>" target="_blank" style="color: rgba(255,255,255,0.7); font-size: 13px; text-decoration: underline; margin-bottom: 20px; display: inline-block; transition: 0.3s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">
                Договір публічної оферти
            </a>

            <p style="margin-top: 10px; opacity: 0.5; font-size: 12px;">© 2026 МісцеЄ. Всі права захищені.</p>
        </div>
    </footer>

    <div class="modal-overlay" id="bookingModal">
        <div class="modal-content">
            <div class="close-modal" onclick="closeModal()">&times;</div>
            <div class="modal-header">
                <h3>Залишити заявку</h3>
                <p>З Вами зв'яжеться наш менеджер</p>
            </div>
            <div class="modal-body">
                <div class="selected-box-display" id="modalBoxTitle">
                    Ви обрали: Бокс 1.5 м³
                </div>
                <form id="bookingForm" onsubmit="submitForm(event)">
                    <input type="hidden" id="boxTypeInput" name="boxType" value="">
                    <div class="form-group">
                        <input type="text" name="name" class="form-input" placeholder="Ваше ім'я*" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" class="form-input" placeholder="Номер телефону*" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-input" placeholder="Електронна пошта (необов'язково)">
                    </div>
                    <button type="submit" class="btn-submit">Підтвердити</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
        
        // --- ДАНІ ДЛЯ КАЛЬКУЛЯТОРА З CMS ---
        const boxes = [
            { id: '1m3', val: 1, label: '1 м³', price: <cms:editable name='price_1m3' group='group_prices' type='text'>450</cms:editable>, img: 'images/image_f39daa.jpg', desc: 'Коробка, валіза, гантелі' },
            { id: '1.5m3', val: 1.5, label: '1.5 м³', price: <cms:editable name='price_1_5m3' group='group_prices' type='text'>675</cms:editable>, img: 'images/image_f39db1.jpg', desc: 'Синя коробка, шини' },
            { id: '2m2', val: 2, label: '2 м²', price: <cms:editable name='price_2m2' group='group_prices' type='text'>900</cms:editable>, img: 'images/image_f39dcf.jpg', desc: 'Шини, шафа, лампа' },
            { id: '3m2', val: 3, label: '3 м²', price: <cms:editable name='price_3m2' group='group_prices' type='text'>1350</cms:editable>, img: 'images/image_f3a1aa.jpg', desc: 'Стіл, шафа, шини' },
            { id: '4m2', val: 4, label: '4 м²', price: <cms:editable name='price_4m2' group='group_prices' type='text'>1600</cms:editable>, img: 'images/image_f3a1e7.jpg', desc: 'Стіл, шафа, коробки' },
            { id: '5m2', val: 5, label: '5 м²', price: <cms:editable name='price_5m2' group='group_prices' type='text'>2000</cms:editable>, img: 'images/image_f3a224.jpg', desc: 'Червоний диван' },
            { id: '6m2', val: 6, label: '6 м²', price: <cms:editable name='price_6m2' group='group_prices' type='text'>2400</cms:editable>, img: 'images/image_f3a264.jpg', desc: 'Диван, велосипед' }
        ];

        const cars = {
            'sedan': { default: '1.5m3', allowed: [1, 1.5, 2] },
            'pickup': { default: '3m2', allowed: [2, 3, 4] },
            'van': { default: '6m2', allowed: [4, 5, 6] }
        };
        const discounts = { 1: 0, 3: 0, 6: 0, 12: 0.05, 15: 0.07 };
        let currentCar = 'sedan'; let currentBoxId = '1.5m3'; let currentDuration = 1;
        
        const sizesContainer = document.getElementById('sizesContainer');
        const visualImage = document.getElementById('visualImage');
        const visualBadge = document.getElementById('visualBadge');
        const resultTitle = document.getElementById('resultTitle');
        const promoBadge = document.getElementById('promoBadge');
        const resultPriceEl = document.getElementById('resultPrice');
        const oldPriceEl = document.getElementById('oldPrice');
        const totalSumEl = document.getElementById('totalSum');

        function setCar(carType) {
            currentCar = carType;
            document.querySelectorAll('.vehicle-btn').forEach(btn => btn.classList.remove('active'));
            const targetBtn = document.querySelector(`.vehicle-btn[onclick="setCar('${carType}')"]`);
            if(targetBtn) targetBtn.classList.add('active');
            setBox(cars[carType].default);
        }

        function setBox(id) {
            currentBoxId = id;
            const box = boxes.find(b => b.id === id);
            visualImage.src = box.img;
            visualImage.alt = box.desc; 
            visualBadge.innerText = box.label;
            resultTitle.innerText = `Бокс ${box.label}`;
            updatePriceDisplay();
            renderSizes();
        }

        function setDuration(months) {
            currentDuration = months;
            document.querySelectorAll('.term-btn').forEach(btn => {
                btn.classList.remove('active');
                if(btn.onclick.toString().includes(`setDuration(${months})`)) btn.classList.add('active');
            });
            updatePriceDisplay();
        }

        function updatePriceDisplay() {
            const box = boxes.find(b => b.id === currentBoxId);
            const basePrice = box.price;
            const discount = discounts[currentDuration];
            const discountedMonthlyPrice = Math.round(basePrice * (1 - discount));
            const total = discountedMonthlyPrice * currentDuration;
            resultPriceEl.innerText = discountedMonthlyPrice;
            if (discount > 0) {
                oldPriceEl.innerText = basePrice;
                oldPriceEl.style.display = 'inline-block';
                resultPriceEl.style.color = '#e1306c';
            } else {
                oldPriceEl.style.display = 'none';
                resultPriceEl.style.color = 'var(--primary)';
            }
            if (currentDuration >= 15) {
                promoBadge.style.display = 'block';
                promoBadge.innerText = `Акція активована! (-${7}%)`;
            } else {
                promoBadge.style.display = 'none';
            }
            totalSumEl.innerText = `Разом: ${total} грн за ${currentDuration} міс.`;
        }

        function renderSizes() {
            sizesContainer.innerHTML = '';
            const allowedVals = cars[currentCar].allowed;
            boxes.forEach(box => {
                const btn = document.createElement('div');
                const isAllowed = allowedVals.includes(box.val);
                const isActive = box.id === currentBoxId;
                btn.className = `size-btn ${isActive ? 'active' : ''} ${!isAllowed ? 'disabled' : ''}`;
                btn.innerHTML = `<span class="size-val">${box.label}</span><span class="size-price">${box.price} ₴</span>`;
                if (isAllowed) btn.onclick = () => setBox(box.id);
                sizesContainer.appendChild(btn);
            });
        }

        // --- ЛОГІКА МОДАЛЬНОГО ВІКНА ---
        const modal = document.getElementById('bookingModal');
        const modalBoxTitle = document.getElementById('modalBoxTitle');
        const boxTypeInput = document.getElementById('boxTypeInput');

        function openModal(type) {
            modal.classList.add('active');
            
            if(type === 'excursion') {
                modalBoxTitle.innerText = "Запис на ЕКСКУРСІЮ";
                boxTypeInput.value = "Екскурсія";
            } else {
                // Беремо поточний вибраний бокс
                const box = boxes.find(b => b.id === currentBoxId);
                modalBoxTitle.innerText = `Ви обрали: Бокс ${box.label} (${currentDuration} міс)`;
                boxTypeInput.value = `Бокс ${box.label}, ${currentDuration} міс., Ціна: ${resultPriceEl.innerText} грн`;
            }
        }

        function closeModal() {
            modal.classList.remove('active');
        }

        // Закриття по кліку на фон
        modal.onclick = function(e) {
            if(e.target === modal) closeModal();
        }

        function submitForm(e) {
            e.preventDefault();
            const form = document.getElementById('bookingForm');
            const formData = new FormData(form);

            // Відправка на PHP
            fetch('send-mail.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert('Дякуємо! Заявка відправлена. Менеджер зв\'яжеться з вами.');
                closeModal();
                form.reset();
            })
            .catch(error => {
                alert('Помилка відправки. Зателефонуйте нам.');
                console.error('Error:', error);
            });
        }

        renderSizes();
        document.querySelector('.vehicle-btn').classList.add('active');
        setBox('1.5m3'); 
    </script>
</body>
</html>
<?php COUCH::invoke(); ?>