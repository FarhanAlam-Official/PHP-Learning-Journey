<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Learning Journey</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: rgba(79, 70, 229, 0.1);
            --primary-dark: #4338ca;
            --secondary: #0ea5e9;
            --secondary-light: rgba(14, 165, 233, 0.1);
            --dark: #0f172a;
            --light: #f8fafc;
            --white: #ffffff;
            --gray: #475569;
            --muted: #94a3b8;
            --border-radius: 14px;
            --box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Liberation Sans', sans-serif;
            background: linear-gradient(135deg, var(--primary-light), rgba(14, 165, 233, 0.08));
            color: var(--dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        a {
            color: inherit;
        }

        .page-wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Top navigation */
        .top-nav {
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: saturate(160%) blur(8px);
            transition: background .2s ease, box-shadow .2s ease, border-color .2s ease;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.04), rgba(14, 165, 233, 0.035));
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        }

        .top-nav.is-scrolled {
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            border-color: rgba(226, 232, 240, 0.9);
        }

        .top-nav-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            justify-content: space-between;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-mark {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 6px 18px rgba(79, 70, 229, 0.35);
        }

        .brand-name {
            font-weight: 800;
            letter-spacing: -0.3px;
            font-size: 1.1rem;
            color: var(--dark);
        }

        .brand-name strong {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-area {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-links a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 10px;
            color: var(--gray);
            font-weight: 600;
            transition: color .15s ease, background .15s ease;
        }

        .nav-links a:hover {
            color: var(--primary);
            background: var(--primary-light);
        }

        .pill {
            padding: 6px 10px;
            border-radius: 999px;
            background: var(--primary-light);
            color: var(--primary);
            font-weight: 700;
            font-size: 0.82rem;
            border: 1px solid rgba(79, 70, 229, 0.15);
        }

        .link-btn {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 10px;
            color: var(--primary);
            background: var(--white);
            border: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: var(--box-shadow);
            font-size: 0.9rem;
            font-weight: 600;
            transition: all .2s ease;
        }

        .link-btn:hover {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }

        .menu-toggle {
            display: none;
            border: 1px solid rgba(226, 232, 240, 0.9);
            background: var(--white);
            color: var(--primary);
            padding: 6px 10px;
            border-radius: 10px;
            font-weight: 700;
        }

        /* Hero */
        .hero {
            position: relative;
            margin: 0 0 40px;
            border-radius: 0 0 20px 20px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary-light), rgba(14, 165, 233, 0.08));
            min-height: min(100dvh, 100vh);
            width: 100vw;
            margin-left: calc(50% - 50vw);
            margin-right: calc(50% - 50vw);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-top: none;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.08);
        }

        .hero-inner {
            position: relative;
            padding: clamp(28px, 5vw, 56px);
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 32px;
            align-items: center;
            min-height: inherit;
            max-width: 1200px;
            margin: 0 auto;
        }

        

        .hero-art {
            position: relative;
            min-height: 220px;
            display: block;
        }

        .hero-bubbles {
            position: absolute;
            inset: -20% -10% auto -10%;
            pointer-events: none;
            filter: blur(18px);
            opacity: .7;
        }

        .bubble {
            position: absolute;
            border-radius: 999px;
        }

        .b1 {
            width: 180px;
            height: 180px;
            background: rgba(79, 70, 229, 0.25);
            top: 10%;
            left: 6%;
        }

        .b2 {
            width: 140px;
            height: 140px;
            background: rgba(14, 165, 233, 0.22);
            top: 30%;
            left: 45%;
        }

        .b3 {
            width: 220px;
            height: 220px;
            background: rgba(99, 102, 241, 0.18);
            top: -8%;
            left: 70%;
        }

        h1 {
            font-weight: 800;
            font-size: clamp(2.1rem, 3.3vw + 1rem, 3.6rem);
            line-height: 1.1;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
            margin-bottom: 16px;
        }

        .tagline {
            font-size: clamp(1.05rem, .9vw + .6rem, 1.25rem);
            color: var(--gray);
            font-weight: 500;
            max-width: 60ch;
            line-height: 1.7;
            margin-top: 6px;
        }

        .cta-row {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-top: 22px;
        }

        .cta-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            padding: 12px 16px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            box-shadow: 0 10px 24px rgba(79, 70, 229, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .cta-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--white);
            color: var(--primary);
            padding: 12px 16px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            border: 1px solid rgba(226, 232, 240, 0.9);
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .cta-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(79, 70, 229, 0.30);
        }

        .cta-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.06);
            background: #f9fbff;
        }

        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 12px;
            margin-top: 22px;
        }

        /* Mini highlights: compact, uncluttered feature cues */
        .mini-highlights {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 12px;
            margin-top: 18px;
        }

        .highlight-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            background: var(--white);
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 12px;
            box-shadow: var(--box-shadow);
            color: var(--gray);
            font-weight: 600;
        }

        .highlight-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
        }


        .quick-pill {
            background: #fff;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid rgba(226, 232, 240, 0.9);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .quick-num {
            font-weight: 800;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .quick-label {
            color: var(--muted);
            font-weight: 600;
            font-size: .85rem;
        }

        /* Intro */
        .intro {
            text-align: center;
            margin: 28px auto 36px;
            color: var(--gray);
            font-size: 1.05rem;
            line-height: 1.8;
            max-width: 900px;
            background: var(--white);
            padding: 26px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        /* Stats */
        .stats-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: var(--white);
            padding: 24px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            text-align: center;
            border-top: 4px solid var(--primary);
            transition: transform .25s ease, box-shadow .25s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        }

        .stat-number {
            font-size: 2.1rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 6px;
        }

        .stat-label {
            color: var(--muted);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1.1px;
        }

        /* Progress */
        .progress-container {
            margin: 10px 0 34px;
            text-align: center;
            background: var(--white);
            padding: 26px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .progress-container h3 {
            color: var(--primary);
            font-size: 1.35rem;
            margin-bottom: 16px;
            font-weight: 800;
            letter-spacing: -.2px;
        }

        .progress-bar {
            height: 14px;
            background-color: rgba(226, 232, 240, 0.9);
            border-radius: 999px;
            margin: 16px auto;
            max-width: 680px;
            overflow: hidden;
            position: relative;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transition: width 1s ease;
            position: relative;
        }

        .progress-fill::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .35), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .progress-text {
            font-size: 1rem;
            color: var(--primary);
            margin-top: 8px;
            font-weight: 800;
        }

        .progress-description {
            color: var(--muted);
            font-size: 0.9rem;
            margin-top: 8px;
        }

        /* Timeline */
        .timeline-section {
            background: var(--white);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 28px;
            margin: 28px 0;
        }
        .timeline-header { text-align: center; max-width: 860px; margin: 0 auto 12px; }
        .timeline-title { font-weight: 800; font-size: clamp(1.6rem, 1.4vw + 1rem, 2rem); letter-spacing: -0.2px; color: var(--dark); }
        .timeline-subtext { margin-top: 8px; color: var(--muted); }
        .timeline-track { position: relative; margin-top: 22px; }
        .timeline-axis { position: absolute; left: 50%; top: 0; bottom: 0; width: 6px; transform: translateX(-50%); background:
            repeating-linear-gradient( to bottom, rgba(79,70,229,.35) 0 16px, rgba(255,255,255,1) 16px 26px ); border-radius: 999px; box-shadow: 0 0 0 6px rgba(79,70,229,.08); }
        .timeline-items { display: flex; flex-direction: column; gap: 18px; }
        .timeline-item { display: flex; align-items: center; gap: 16px; }
        .tl-col { flex: 1 1 50%; }
        .tl-col.left { text-align: right; padding-right: 18px; }
        .tl-col.right { text-align: left; padding-left: 18px; }
        .tl-node { z-index: 1; display: inline-flex; align-items: center; justify-content: center; width: 54px; height: 54px; border-radius: 999px; background: #ffffff; border: 6px solid var(--light); box-shadow: 0 10px 22px rgba(15,23,42,.10); }
        .tl-node-inner { width: 36px; height: 36px; border-radius: 999px; background: var(--primary-light); display: inline-flex; align-items: center; justify-content: center; color: var(--primary); font-weight: 900; }
        .tl-node-inner.is-complete { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; }
        .tl-card { display: inline-block; max-width: 420px; background: var(--white); border: 1px solid rgba(226,232,240,.9); border-radius: 14px; box-shadow: var(--box-shadow); padding: 14px; text-align: left; }
        .tl-title { font-weight: 700; color: var(--dark); }
        .tl-desc { color: var(--muted); margin-top: 6px; font-size: .95rem; }
        .tl-actions { margin-top: 10px; }
        .tl-btn { display: inline-flex; align-items: center; gap: 8px; padding: 8px 12px; border-radius: 10px; background: var(--white); color: var(--primary); border: 1px solid rgba(226,232,240,.9); font-weight: 700; text-decoration: none; cursor: pointer; }
        .tl-btn:hover { background: var(--primary); color: #fff; border-color: var(--primary); }
        .tl-btn-primary { background: linear-gradient(135deg, var(--primary), var(--secondary)); color: #fff; border-color: transparent; box-shadow: 0 12px 24px rgba(79,70,229,.22); }
        .tl-btn-primary:hover { filter: brightness(1.05); box-shadow: 0 14px 28px rgba(79,70,229,.28); }
        .tl-enc { margin-top: 10px; padding: 10px 12px; background: #f8fafc; border: 1px dashed rgba(226,232,240,.9); border-radius: 10px; color: var(--gray); display: none; }
        .dialog-backdrop { position: fixed; inset: 0; background: rgba(15,23,42,.35); display: none; align-items: center; justify-content: center; z-index: 200; }
        .dialog-backdrop.open { display: flex; }
        .dialog { background: #fff; border: 1px solid rgba(226,232,240,.9); border-radius: 14px; box-shadow: 0 20px 40px rgba(15,23,42,.18); max-width: 520px; width: calc(100% - 32px); padding: 18px; }
        .dialog h4 { font-size: 1.2rem; font-weight: 800; color: var(--dark); }
        .dialog p { color: var(--gray); margin-top: 8px; }
        .dialog .dialog-actions { margin-top: 14px; text-align: right; }
        .dialog .close-btn { padding: 8px 12px; border-radius: 10px; border: 1px solid rgba(226,232,240,.9); background: #fff; font-weight: 700; }
        .dialog .close-btn:hover { background: var(--primary); color: #fff; border-color: var(--primary); }

        /* Overlay loader for Learning Path */
        .lp-overlay { position: fixed; inset: 0; background: rgba(15,23,42,.55); display: none; align-items: center; justify-content: center; z-index: 300; }
        .lp-overlay.open { display: flex; }
        .lp-panel { width: min(1100px, calc(100% - 28px)); max-height: calc(100% - 28px); overflow: auto; background: #fff; border: 1px solid rgba(226,232,240,.9); border-radius: 16px; box-shadow: 0 30px 60px rgba(15,23,42,.25); position: relative; }
        .lp-close { position: absolute; top: 10px; right: 10px; border: 1px solid rgba(226,232,240,.9); background: #fff; color: var(--gray); border-radius: 10px; padding: 6px 10px; font-weight: 800; cursor: pointer; }
        .lp-close:hover { background: var(--primary); color: #fff; border-color: var(--primary); }

        /* Content container */
        .container {
            background-color: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 28px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
            justify-content: space-between;
            margin-top: 4px;
        }

        .search-input {
            flex: 1 1 320px;
            background: var(--white);
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 0.95rem;
            color: var(--dark);
            box-shadow: var(--box-shadow);
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
        }

        /* Grid of days */
        .days-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 18px;
            margin-top: 22px;
        }

        .day-card {
            background: var(--white);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
            position: relative;
            border: 1px solid rgba(226, 232, 240, 0.9);
        }

        .day-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 28px rgba(79, 70, 229, 0.15);
            border-color: rgba(79, 70, 229, 0.35);
        }

        .day-card a {
            display: block;
            text-decoration: none;
            color: inherit;
            height: 100%;
        }

        .day-number {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            font-size: 1.2rem;
            font-weight: 800;
            padding: 12px 0;
            text-align: center;
            letter-spacing: .4px;
        }

        .day-content {
            padding: 14px;
            text-align: center;
        }

        .day-title {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
            font-size: 1rem;
            letter-spacing: -.1px;
        }

        .view-btn {
            display: inline-block;
            background-color: var(--primary-light);
            color: var(--primary);
            border: 1px solid rgba(79, 70, 229, 0.15);
            padding: 8px 14px;
            border-radius: 999px;
            margin-top: 6px;
            font-size: 0.85rem;
            font-weight: 700;
            transition: all 0.25s ease;
        }

        .day-card:hover .view-btn {
            background-color: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding: 36px 0;
            border-top: 1px solid rgba(226, 232, 240, 0.9);
            background:
                radial-gradient(1200px 400px at 50% -10%, rgba(79, 70, 229, 0.08), transparent 60%),
                radial-gradient(900px 300px at 85% 0%, rgba(14, 165, 233, 0.08), transparent 60%),
                linear-gradient(180deg, rgba(79, 70, 229, 0.04), rgba(14, 165, 233, 0.035));
            box-shadow: inset 0 8px 20px rgba(15, 23, 42, 0.04);
            width: 100vw;
            margin-left: calc(50% - 50vw);
            margin-right: calc(50% - 50vw);
        }

        .footer-inner {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 18px 24px;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .footer-left {
            color: var(--gray);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .footer-right {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }

        .credit {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7)) padding-box,
                linear-gradient(135deg, rgba(79, 70, 229, 0.35), rgba(14, 165, 233, 0.35)) border-box;
            border: 1px solid transparent;
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.10);
            color: var(--dark);
            font-weight: 700;
            backdrop-filter: blur(8px);
            transition: transform .2s ease, box-shadow .2s ease, filter .2s ease;
        }

        .credit a {
            color: var(--primary);
            text-decoration: none;
            transition: color .2s ease;
        }

        .credit:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(15, 23, 42, 0.14);
            filter: saturate(1.02);
        }

        .credit:hover a {
            color: var(--primary-dark);
        }

        .credit::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: linear-gradient(120deg, transparent 30%, rgba(255, 255, 255, 0.75) 50%, transparent 70%);
            transform: translateX(-140%);
            pointer-events: none;
        }

        .credit:hover::after {
            animation: sheen 1200ms ease forwards;
        }

        @keyframes sheen {
            to { transform: translateX(140%); }
        }

        /* Glowing heart in credit */
        .credit span[aria-hidden="true"] {
            display: inline-block;
            animation: heartGlow 2.4s ease-in-out infinite;
            filter: drop-shadow(0 0 0 rgba(255, 0, 90, 0));
        }

        @keyframes heartGlow {
            0%, 100% {
                transform: scale(1);
                text-shadow: 0 0 6px rgba(255, 0, 90, 0.25), 0 0 12px rgba(255, 0, 90, 0.15);
                filter: drop-shadow(0 0 4px rgba(255, 0, 90, 0.20));
            }
            50% {
                transform: scale(1.08);
                text-shadow: 0 0 10px rgba(255, 0, 90, 0.45), 0 0 20px rgba(255, 0, 90, 0.30);
                filter: drop-shadow(0 0 8px rgba(255, 0, 90, 0.35));
            }
        }

        /* Floating Back-to-Top FAB */
        #backToTopFab {
            position: fixed;
            right: 20px;
            bottom: 20px;
            width: 52px;
            height: 52px;
            border-radius: 999px;
            border: 1px solid rgba(226, 232, 240, 0.9);
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            box-shadow: 0 14px 28px rgba(79, 70, 229, 0.25);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            cursor: pointer;
            opacity: 0;
            transform: translateY(10px);
            pointer-events: none;
            transition: opacity .25s ease, transform .25s ease, box-shadow .2s ease;
            z-index: 100;
        }

        #backToTopFab.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        #backToTopFab:hover {
            box-shadow: 0 18px 36px rgba(79, 70, 229, 0.35);
        }

        /* Responsive */
        @media (max-width: 960px) {
            .hero-inner {
                grid-template-columns: 1fr;
            }

            .hero-art {
                display: none;
            }
        }

        @media (max-width: 840px) {
            .nav-links {
                display: none;
            }

            .menu-toggle {
                display: inline-flex;
            }
        }

        @media (max-width: 768px) {
            .page-wrapper {
                padding: 0 16px 16px;
            }

            .top-nav-inner {
                padding: 10px 16px;
            }

            .hero-inner {
                padding: 24px;
            }

            .days-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
                gap: 14px;
            }

            .footer-inner {
                grid-template-columns: 1fr;
                text-align: center;
                justify-items: center;
                padding: 0 16px;
            }
        }

        /* Mobile dropdown */
        .mobile-menu {
            display: none;
            position: absolute;
            left: 0;
            right: 0;
            top: 100%;
            background: #fff;
            border-bottom: 1px solid rgba(226, 232, 240, 0.9);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .06);
        }

        .mobile-menu.open {
            display: block;
        }

        .mobile-menu a {
            display: block;
            padding: 12px 24px;
            color: var(--gray);
            text-decoration: none;
            border-top: 1px solid rgba(226, 232, 240, 0.7);
            font-weight: 600;
        }

        .mobile-menu a:hover {
            background: var(--primary-light);
            color: var(--primary);
        }
    </style>
</head>

<body>
    <?php
    function getDayFiles()
    {
        $allFiles = glob("Day_*.php");
        $mainDayFiles = array_filter($allFiles, function ($file) {
            return preg_match('/^Day_\d+\.php$/', $file);
        });
        sort($mainDayFiles, SORT_NATURAL);
        return $mainDayFiles;
    }
    $dayFiles = getDayFiles();
    $totalDays = count($dayFiles);
    $progressPercentage = ($totalDays / 25) * 100; // Assuming 25 days total
    $firstDay = $totalDays > 0 ? $dayFiles[0] : null;
    ?>

    <!-- Top Nav -->
    <nav class="top-nav" id="topnav">
        <div class="top-nav-inner">
            <a href="#overview" class="brand">
                <span class="brand-name">PHP <strong>Journey</strong></span>
            </a>
            <div class="nav-area">
                <div class="nav-links" aria-label="Primary">
                    <a href="#overview">Overview</a>
                    <a href="#progress">Progress</a>
                    <a href="#days">Days</a>
                    <a href="./path.php">Learning Path</a>
                    <a class="link-btn" href="https://github.com/FarhanAlam-Official" target="_blank" rel="noopener noreferrer">GitHub</a>
                </div>
                <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">☰</button>
            </div>
        </div>
        <div class="mobile-menu" id="mobileMenu" aria-label="Mobile menu">
            <a href="#overview">Overview</a>
            <a href="#progress">Progress</a>
            <a href="#days">Days</a>
            <a href="https://github.com/FarhanAlam-Official" target="_blank" rel="noopener noreferrer">GitHub</a>
        </div>
    </nav>

    <div class="page-wrapper">
        <!-- Landing Hero -->
        <section class="hero" id="overview" aria-label="Overview">
            <div class="hero-inner">
                <div class="hero-copy">
                    <h1>PHP Learning Journey</h1>
                    <p class="tagline">A curated 25‑day roadmap from beginner to professional developer — with projects, progress tracking, and real‑world skills.</p>
                    <div class="cta-row">
                        <?php if ($firstDay): ?>
                            <a class="cta-primary" href="./<?= htmlspecialchars($firstDay, ENT_QUOTES) ?>">Start at Day 1 →</a>
                        <?php endif; ?>
                        <a class="cta-secondary" href="#days">Explore all days</a>
                        <span class="pill" title="Days completed"><?= $totalDays ?> / 25</span>
                    </div>
                    <div class="mini-highlights" aria-label="Highlights">
                        <div class="highlight-card"><span class="highlight-dot"></span><span>Beginner‑friendly, structured roadmap</span></div>
                        <div class="highlight-card"><span class="highlight-dot"></span><span>Hands‑on projects and demos</span></div>
                        <div class="highlight-card"><span class="highlight-dot"></span><span>Track progress visually</span></div>
                    </div>
                    <div class="quick-stats">
                        <div class="quick-pill"><span class="quick-num"><?= $totalDays ?></span><span class="quick-label">Days Completed</span></div>
                        <div class="quick-pill"><span class="quick-num"><?= round($progressPercentage) ?>%</span><span class="quick-label">Overall Progress</span></div>
                        <div class="quick-pill"><span class="quick-num">10+</span><span class="quick-label">Projects Built</span></div>
                    </div>
                </div>
                <div class="hero-art" aria-hidden="true">
                    <div class="hero-bubbles">
                        <div class="bubble b1"></div>
                        <div class="bubble b2"></div>
                        <div class="bubble b3"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="intro">
            <?php
            echo "Welcome to my comprehensive PHP learning portfolio! This interactive showcase demonstrates 25 days of intensive coding practice, featuring real-world applications, modern web development techniques, and progressive skill building. Each day represents a step forward in mastering PHP and full-stack development.";
            ?>
        </section>

        <section class="stats-section" aria-label="Learning statistics">
            <div class="stat-card">
                <div class="stat-number"><?= $totalDays ?></div>
                <div class="stat-label">Days Completed</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= round($progressPercentage) ?>%</div>
                <div class="stat-label">Progress Made</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">50+</div>
                <div class="stat-label">Concepts Learned</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">10+</div>
                <div class="stat-label">Projects Built</div>
            </div>
        </section>

        <section class="progress-container" id="progress" aria-label="Progress bar">
            <h3>🚀 Learning Progress</h3>
            <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?= round($progressPercentage) ?>">
                <div class="progress-fill" style="width: <?= $progressPercentage; ?>%"></div>
            </div>
            <div class="progress-text">
                <?= $totalDays; ?> of 25 days completed (<?= round($progressPercentage); ?>%)
            </div>
            <div class="progress-description">
                <?php
                if ($progressPercentage == 100) {
                    echo "🎉 Congratulations! Journey Complete!";
                } elseif ($progressPercentage >= 80) {
                    echo "🔥 Almost there! Final sprint mode!";
                } elseif ($progressPercentage >= 50) {
                    echo "💪 Great momentum! Keep going strong!";
                } else {
                    echo "🌱 Building foundations step by step!";
                }
                ?>
            </div>
        </section>

        <section class="container" id="days" aria-label="Days list">
            <div class="toolbar">
                <label for="search-days" class="sr-only" style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;">Search days</label>
                <input type="text" id="search-days" class="search-input" placeholder="Search days by number or title..." aria-label="Search days by number or title">
            </div>
            <div class="days-grid">
                <?php
                foreach ($dayFiles as $file) {
                    $dayNumber = str_replace(["Day_", ".php"], "", $file);
                    $titles = [
                        "1" => "PHP Basics",
                        "2" => "Variables & Data Types",
                        "3" => "Arrays in PHP",
                        "4" => "Control Structures",
                        "5" => "Functions",
                        "6" => "Product Showcase",
                        "7" => "Form Handling",
                        "8" => "POST Method",
                        "9" => "Sessions",
                        "10" => "Login System",
                        "11" => "Cookies",
                        "12" => "Cookie Management",
                        "13" => "Multi-page Website",
                        "14" => "Database Connection",
                        "15" => "Database Queries",
                        "16" => "CRUD Operations",
                        "17" => "Product Database",
                        "18" => "User Registration",
                        "19" => "User Management",
                        "20" => "Advanced CRUD",
                        "21" => "File Management",
                        "22" => "Encoding & Decoding",
                        "23" => "Email System",
                        "24" => "API Development",
                        "25" => "Portfolio Complete"
                    ];
                    $title = isset($titles[$dayNumber]) ? $titles[$dayNumber] : "PHP Day $dayNumber";
                    echo '<div class="day-card" data-title="' . strtolower($title) . '" data-day="' . $dayNumber . '">
                        <a href="./' . $file . '">
                            <div class="day-number">Day ' . $dayNumber . '</div>
                            <div class="day-content">
                                <div class="day-title">' . $title . '</div>
                                <div class="view-btn">View Project</div>
                            </div>
                        </a>
                      </div>';
                }
                ?>
            </div>
        </section>

        <footer class="footer">
            <div class="footer-inner">
                <div class="footer-left">
                    <div>Last updated: <?php echo date("F j, Y"); ?></div>
                    <div>PHP Learning Journey — Building skills one day at a time</div>
                </div>
                <div class="footer-right">
                    <span class="credit">Made with <span aria-hidden="true">❤️</span> by <a href="https://github.com/FarhanAlam-Official" target="_blank" rel="noopener noreferrer">Farhan Alam</a></span>
                </div>
            </div>
        </footer>
        <button id="backToTopFab" aria-label="Back to top" title="Back to top" type="button">↑</button>
        
    </div>

    <script>
        (function() {
            // Search filter
            var input = document.getElementById('search-days');
            if (input) {
                var cards = Array.prototype.slice.call(document.querySelectorAll('.day-card'));
                input.addEventListener('input', function(e) {
                    var q = (e.target.value || '').toLowerCase().trim();
                    cards.forEach(function(card) {
                        var title = card.getAttribute('data-title') || '';
                        var day = card.getAttribute('data-day') || '';
                        var match = !q || title.indexOf(q) !== -1 || ('day ' + day).indexOf(q) !== -1 || day.indexOf(q) !== -1;
                        card.style.display = match ? '' : 'none';
                    });
                });
            }

            // Sticky nav state
            var nav = document.getElementById('topnav');
            var onScroll = function() {
                if (window.scrollY > 8) nav.classList.add('is-scrolled');
                else nav.classList.remove('is-scrolled');
            };
            onScroll();
            window.addEventListener('scroll', onScroll);

            // Mobile menu toggle
            var toggle = document.getElementById('menuToggle');
            var menu = document.getElementById('mobileMenu');
            if (toggle && menu) {
                toggle.addEventListener('click', function() {
                    menu.classList.toggle('open');
                });
                menu.querySelectorAll('a').forEach(function(a) {
                    a.addEventListener('click', function() {
                        menu.classList.remove('open');
                    });
                });
            }

            // Back-to-top FAB: visible only when footer enters viewport
            var fab = document.getElementById('backToTopFab');
            var footer = document.querySelector('.footer');
            if (fab && footer && 'IntersectionObserver' in window) {
                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            fab.classList.add('show');
                        } else {
                            fab.classList.remove('show');
                        }
                    });
                }, { root: null, threshold: 0.05 });
                observer.observe(footer);

                fab.addEventListener('click', function() {
                    var target = document.getElementById('overview');
                    if (target && typeof target.scrollIntoView === 'function') {
                        target.scrollIntoView({ behavior: 'smooth' });
                    } else {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                });
            }

            // Removed overlay loader (Path is now a standalone page)

            // Inline encouragement reveal (no modal)
            document.querySelectorAll('.tl-btn-primary').forEach(function(btn){
                btn.addEventListener('click', function(){
                    var milestone = btn.getAttribute('data-encouragement') || 'your milestone';
                    var box = btn.closest('.tl-card').querySelector('.tl-enc');
                    if (!box) return;
                    box.style.display = 'block';
                    box.textContent = 'Great job on ' + milestone + '! You\'re building real skills. Keep the momentum—next step is even easier than you think.';
                });
            });
        })();
    </script>
</body>

</html>