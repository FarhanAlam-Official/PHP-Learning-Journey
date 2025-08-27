<?php
// Learning Path Timeline include
// Requires variables: $totalDays
?>
        <!-- Learning Path Timeline -->
        <section class="timeline-section" id="path" aria-label="Learning Path">
            <div class="timeline-header">
                <h2 class="timeline-title">My Learning Path</h2>
                <p class="timeline-subtext">Tracking progress through key PHP milestones.</p>
                <?php
                $completedCount = $totalDays; $totalCount = 6; $lpProgress = min(100, ($completedCount / $totalCount) * 100);
                ?>
                <div class="progress-bar" aria-hidden="true">
                    <div class="progress-fill" style="width: <?= round($lpProgress); ?>%"></div>
                </div>
                <div class="progress-text"><?= min($completedCount, $totalCount); ?> of <?= $totalCount; ?> milestones complete (<?= round($lpProgress); ?>%)</div>
            </div>

            <?php
            $milestones = [
                [ 'title' => 'PHP Basics', 'desc' => 'Variables, data types, control structures, and syntax.', 'done' => true ],
                [ 'title' => 'Functions', 'desc' => 'Reusable code with parameters and return values.', 'done' => true ],
                [ 'title' => 'OOP in PHP', 'desc' => 'Classes, objects, inheritance, and polymorphism.', 'done' => $totalDays >= 10 ],
                [ 'title' => 'Working with Databases', 'desc' => 'Connect with PDO, run queries, manage data.', 'done' => $totalDays >= 14 ],
                [ 'title' => 'Building Projects', 'desc' => 'Hands-on apps like blog or e-commerce.', 'done' => $totalDays >= 19 ],
                [ 'title' => 'Frameworks (Laravel)', 'desc' => 'Modern, scalable apps with Laravel.', 'done' => false ],
            ];
            ?>

            <div class="timeline-track">
                <div class="timeline-axis" aria-hidden="true"></div>
                <div class="timeline-items">
                    <?php foreach ($milestones as $i => $m): $left = $i % 2 === 0; ?>
                    <div class="timeline-item">
                        <div class="tl-col <?= $left ? 'left' : '' ?>">
                            <?php if ($left): ?>
                            <div class="tl-card">
                                <div class="tl-title"><?= htmlspecialchars($m['title']) ?></div>
                                <div class="tl-desc"><?= htmlspecialchars($m['desc']) ?></div>
                                <?php if ($m['done']): ?>
                                <div class="tl-actions">
                                    <button class="tl-btn tl-btn-primary" data-encouragement="<?= htmlspecialchars($m['title']) ?>">✨ Get AI Encouragement</button>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="tl-node" aria-hidden="true">
                            <span class="tl-node-inner <?= $m['done'] ? 'is-complete' : '' ?>"></span>
                        </div>
                        <div class="tl-col <?= $left ? '' : 'right' ?>">
                            <?php if (!$left): ?>
                            <div class="tl-card">
                                <div class="tl-title"><?= htmlspecialchars($m['title']) ?></div>
                                <div class="tl-desc"><?= htmlspecialchars($m['desc']) ?></div>
                                <?php if ($m['done']): ?>
                                <div class="tl-actions">
                                    <button class="tl-btn tl-btn-primary" data-encouragement="<?= htmlspecialchars($m['title']) ?>">✨ Get AI Encouragement</button>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        


