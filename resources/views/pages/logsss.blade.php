<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SECURITY LOGS - Process History</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Roboto+Mono:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        .font-orbitron { font-family: 'Orbitron', monospace; }
        .font-mono { font-family: 'Roboto Mono', monospace; }

        .matrix-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            opacity: 0.05;
        }

        .grid-pattern {
            background-image:
                linear-gradient(rgba(0, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 20px 20px;
            animation: gridPulse 6s ease-in-out infinite;
        }

        @keyframes gridPulse {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 0.1; }
        }

        .glow-border {
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
            border: 1px solid rgba(0, 255, 255, 0.2);
        }

        .text-glow {
            text-shadow: 0 0 15px rgba(0, 255, 255, 0.6);
        }

        .pulse-dot {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(0, 255, 0, 0.7); }
            70% { box-shadow: 0 0 0 8px rgba(0, 255, 0, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 255, 0, 0); }
        }

        .log-row:hover {
            background-color: rgba(0, 255, 255, 0.05);
            border-left: 3px solid #00ffff;
        }

        .status-success {
            color: #00ff00;
            text-shadow: 0 0 10px rgba(0, 255, 0, 0.5);
        }

        .status-failed {
            color: #ff4444;
            text-shadow: 0 0 10px rgba(255, 68, 68, 0.5);
        }

        .process-encrypt {
            color: #00ffff;
        }

        .process-decrypt {
            color: #ffaa00;
        }

        .search-glow:focus {
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
            border-color: #00ffff;
        }

        .filter-active {
            background: linear-gradient(45deg, #00ffff, #00ff00);
            color: #000;
        }

        .table-header {
            background: linear-gradient(90deg, rgba(0, 255, 255, 0.1), rgba(0, 255, 0, 0.1));
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.3);
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: rgba(0, 255, 255, 0.3);
            border-radius: 3px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 255, 255, 0.5);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-black via-slate-900 to-blue-900 min-h-screen font-mono text-cyan-100">

    <!-- Matrix Background -->
    <div class="matrix-bg" id="matrixBg"></div>

    <!-- Grid Overlay -->
    <div class="fixed inset-0 grid-pattern z-10"></div>

    <!-- Main Container -->
    <div class="relative z-20 container mx-auto px-4 py-8">

        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="font-orbitron text-5xl font-black text-cyan-400 text-glow mb-3">
                SECURITY LOGS
            </h1>
            <p class="text-green-400 text-lg tracking-widest opacity-80">
                PROCESS HISTORY & MONITORING
            </p>

            <!-- Status Indicator -->
            <div class="flex items-center justify-center mt-6 space-x-4">
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-green-400 rounded-full pulse-dot"></div>
                    <span class="text-green-400 text-sm font-bold">SYSTEM ACTIVE</span>
                </div>
                <div class="text-cyan-400 text-sm">
                    <span id="totalLogs">0</span> TOTAL RECORDS
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="glow-border bg-black bg-opacity-50 backdrop-blur-lg rounded-xl p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <!-- Search Input -->
                <div class="md:col-span-2">
                    <label class="block text-cyan-400 text-sm font-bold mb-2 uppercase tracking-wide">
                        🔍 Search Files
                    </label>
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Search by filename..."
                        class="w-full px-4 py-3 bg-black bg-opacity-70 border border-cyan-400 border-opacity-30 rounded-lg text-cyan-400 font-mono focus:outline-none search-glow transition-all duration-300 placeholder-cyan-400 placeholder-opacity-50"
                    >
                </div>

                <!-- Process Filter -->
                <div>
                    <label class="block text-cyan-400 text-sm font-bold mb-2 uppercase tracking-wide">
                        ⚙️ Process Type
                    </label>
                    <select
                        id="processFilter"
                        class="w-full px-4 py-3 bg-black bg-opacity-70 border border-cyan-400 border-opacity-30 rounded-lg text-cyan-400 font-mono focus:outline-none search-glow transition-all duration-300"
                    >
                        <option value="">All Processes</option>
                        <option value="encrypt">Encryption</option>
                        <option value="decrypt">Decryption</option>
                    </select>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-cyan-400 text-sm font-bold mb-2 uppercase tracking-wide">
                        📊 Status
                    </label>
                    <select
                        id="statusFilter"
                        class="w-full px-4 py-3 bg-black bg-opacity-70 border border-cyan-400 border-opacity-30 rounded-lg text-cyan-400 font-mono focus:outline-none search-glow transition-all duration-300"
                    >
                        <option value="">All Status</option>
                        <option value="success">Success</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
            </div>

            <!-- Filter Actions -->
            <div class="flex flex-wrap items-center justify-between mt-6 gap-4">
                <div class="flex space-x-2">
                    <button
                        id="clearFilters"
                        class="px-4 py-2 bg-red-500 bg-opacity-20 border border-red-500 border-opacity-30 text-red-400 rounded-lg font-bold text-sm hover:bg-opacity-30 transition-all duration-300"
                    >
                        🗑️ CLEAR
                    </button>
                    <button
                        id="refreshLogs"
                        class="px-4 py-2 bg-green-500 bg-opacity-20 border border-green-500 border-opacity-30 text-green-400 rounded-lg font-bold text-sm hover:bg-opacity-30 transition-all duration-300"
                    >
                        🔄 REFRESH
                    </button>
                </div>

                <div class="text-sm text-cyan-400 opacity-70">
                    Showing <span id="filteredCount">0</span> of <span id="totalCount">0</span> records
                </div>
            </div>
        </div>

        <!-- Logs Table -->
        <div class="glow-border bg-black bg-opacity-50 backdrop-blur-lg rounded-xl overflow-hidden">

            <!-- Table Header -->
            <div class="table-header px-6 py-4">
                <div class="grid grid-cols-12 gap-4 items-center font-bold text-sm uppercase tracking-wide">
                    <div class="col-span-3 text-cyan-400">📅 Date & Time</div>
                    <div class="col-span-4 text-cyan-400">📄 File Name</div>
                    <div class="col-span-2 text-cyan-400">⚙️ Process</div>
                    <div class="col-span-2 text-cyan-400">📊 Status</div>
                    <div class="col-span-1 text-cyan-400">🔧 Action</div>
                </div>
            </div>

            <!-- Table Body -->
            <div id="logsContainer" class="max-h-96 overflow-y-auto scrollbar-thin">
                <!-- Logs will be populated here -->
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-center mt-8 space-x-4">
            <button
                id="prevPage"
                class="px-6 py-3 bg-cyan-400 bg-opacity-20 border border-cyan-400 border-opacity-30 text-cyan-400 rounded-lg font-bold hover:bg-opacity-30 transition-all duration-300 disabled:opacity-30 disabled:cursor-not-allowed"
                disabled
            >
                ⬅️ PREV
            </button>

            <div class="flex items-center space-x-2">
                <span class="text-cyan-400 text-sm">Page</span>
                <span id="currentPage" class="text-green-400 font-bold">1</span>
                <span class="text-cyan-400 text-sm">of</span>
                <span id="totalPages" class="text-green-400 font-bold">1</span>
            </div>

            <button
                id="nextPage"
                class="px-6 py-3 bg-cyan-400 bg-opacity-20 border border-cyan-400 border-opacity-30 text-cyan-400 rounded-lg font-bold hover:bg-opacity-30 transition-all duration-300 disabled:opacity-30 disabled:cursor-not-allowed"
                disabled
            >
                NEXT ➡️
            </button>
        </div>

        <!-- Footer -->
        <div class="text-center mt-12 text-cyan-400 text-opacity-60 text-sm">
            <span class="text-green-400">></span> Security monitoring active • All activities logged • Unauthorized access tracked
        </div>
    </div>

    <script>
        // Sample data - dalam aplikasi nyata, ini akan diambil dari server
        const sampleLogs = [
            {
                id: 1,
                datetime: '2024-06-29 14:30:15',
                filename: 'confidential_report.pdf',
                process: 'encrypt',
                status: 'success'
            },
            {
                id: 2,
                datetime: '2024-06-29 14:25:42',
                filename: 'user_database.xlsx',
                process: 'decrypt',
                status: 'success'
            },
            {
                id: 3,
                datetime: '2024-06-29 14:20:18',
                filename: 'financial_data.csv',
                process: 'encrypt',
                status: 'failed'
            },
            {
                id: 4,
                datetime: '2024-06-29 14:15:33',
                filename: 'security_protocols.docx',
                process: 'decrypt',
                status: 'success'
            },
            {
                id: 5,
                datetime: '2024-06-29 14:10:07',
                filename: 'employee_records.pdf',
                process: 'encrypt',
                status: 'success'
            },
            {
                id: 6,
                datetime: '2024-06-29 14:05:21',
                filename: 'system_backup.zip',
                process: 'encrypt',
                status: 'failed'
            },
            {
                id: 7,
                datetime: '2024-06-29 13:58:44',
                filename: 'project_specifications.txt',
                process: 'decrypt',
                status: 'success'
            },
            {
                id: 8,
                datetime: '2024-06-29 13:52:16',
                filename: 'client_contracts.pdf',
                process: 'encrypt',
                status: 'success'
            },
            {
                id: 9,
                datetime: '2024-06-29 13:45:39',
                filename: 'network_config.json',
                process: 'decrypt',
                status: 'failed'
            },
            {
                id: 10,
                datetime: '2024-06-29 13:40:12',
                filename: 'audit_report_2024.xlsx',
                process: 'encrypt',
                status: 'success'
            }
        ];

        let currentLogs = [...sampleLogs];
        let filteredLogs = [...sampleLogs];
        let currentPage = 1;
        const logsPerPage = 5;

        // Matrix Rain Effect
        function createMatrixRain() {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            document.getElementById('matrixBg').appendChild(canvas);

            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;

            const chars = '01ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+-=[]{}|;:,.<>?';
            const charArray = chars.split('');
            const fontSize = 12;
            const columns = canvas.width / fontSize;
            const drops = Array(Math.floor(columns)).fill(1);

            function draw() {
                ctx.fillStyle = 'rgba(0, 0, 0, 0.08)';
                ctx.fillRect(0, 0, canvas.width, canvas.height);

                ctx.fillStyle = '#00ffff';
                ctx.font = fontSize + 'px monospace';

                drops.forEach((y, x) => {
                    const text = charArray[Math.floor(Math.random() * charArray.length)];
                    ctx.fillText(text, x * fontSize, y * fontSize);

                    if (y * fontSize > canvas.height && Math.random() > 0.975) {
                        drops[x] = 0;
                    }
                    drops[x]++;
                });
            }

            setInterval(draw, 50);
        }

        // Render logs table
        function renderLogs() {
            const container = document.getElementById('logsContainer');
            const startIndex = (currentPage - 1) * logsPerPage;
            const endIndex = startIndex + logsPerPage;
            const currentPageLogs = filteredLogs.slice(startIndex, endIndex);

            if (currentPageLogs.length === 0) {
                container.innerHTML = `
                    <div class="p-8 text-center">
                        <div class="text-cyan-400 text-lg mb-2">🔍 No logs found</div>
                        <div class="text-cyan-400 text-opacity-60 text-sm">Try adjusting your search filters</div>
                    </div>
                `;
                return;
            }

            container.innerHTML = currentPageLogs.map(log => `
                <div class="log-row px-6 py-4 border-b border-cyan-400 border-opacity-10 transition-all duration-300">
                    <div class="grid grid-cols-12 gap-4 items-center text-sm">
                        <div class="col-span-3 text-cyan-300 font-mono">
                            ${log.datetime}
                        </div>
                        <div class="col-span-4 text-white font-medium">
                            📄 ${log.filename}
                        </div>
                        <div class="col-span-2">
                            <span class="px-3 py-1 rounded-full text-xs font-bold ${log.process === 'encrypt' ? 'process-encrypt bg-cyan-400 bg-opacity-20' : 'process-decrypt bg-orange-400 bg-opacity-20'}">
                                ${log.process === 'encrypt' ? '🔒 ENCRYPT' : '🔓 DECRYPT'}
                            </span>
                        </div>
                        <div class="col-span-2">
                            <span class="px-3 py-1 rounded-full text-xs font-bold ${log.status === 'success' ? 'status-success bg-green-400 bg-opacity-20' : 'status-failed bg-red-400 bg-opacity-20'}">
                                ${log.status === 'success' ? '✅ SUCCESS' : '❌ FAILED'}
                            </span>
                        </div>
                        <div class="col-span-1">
                            <button class="text-cyan-400 hover:text-cyan-300 transition-colors duration-300" onclick="viewLogDetails(${log.id})">
                                👁️
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');

            updatePagination();
            updateStats();
        }

        // Update pagination
        function updatePagination() {
            const totalPages = Math.ceil(filteredLogs.length / logsPerPage);
            document.getElementById('currentPage').textContent = currentPage;
            document.getElementById('totalPages').textContent = totalPages;

            document.getElementById('prevPage').disabled = currentPage === 1;
            document.getElementById('nextPage').disabled = currentPage === totalPages || totalPages === 0;
        }

        // Update statistics
        function updateStats() {
            document.getElementById('totalLogs').textContent = sampleLogs.length;
            document.getElementById('filteredCount').textContent = filteredLogs.length;
            document.getElementById('totalCount').textContent = sampleLogs.length;
        }

        // Filter logs
        function filterLogs() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const processFilter = document.getElementById('processFilter').value;
            const statusFilter = document.getElementById('statusFilter').value;

            filteredLogs = sampleLogs.filter(log => {
                const matchesSearch = log.filename.toLowerCase().includes(searchTerm);
                const matchesProcess = !processFilter || log.process === processFilter;
                const matchesStatus = !statusFilter || log.status === statusFilter;

                return matchesSearch && matchesProcess && matchesStatus;
            });

            currentPage = 1;
            renderLogs();
        }

        // View log details
        function viewLogDetails(logId) {
            const log = sampleLogs.find(l => l.id === logId);
            if (log) {
                alert(`Log Details:\n\nID: ${log.id}\nDateTime: ${log.datetime}\nFile: ${log.filename}\nProcess: ${log.process.toUpperCase()}\nStatus: ${log.status.toUpperCase()}`);
            }
        }

        // Event listeners
        document.getElementById('searchInput').addEventListener('input', filterLogs);
        document.getElementById('processFilter').addEventListener('change', filterLogs);
        document.getElementById('statusFilter').addEventListener('change', filterLogs);

        document.getElementById('clearFilters').addEventListener('click', function() {
            document.getElementById('searchInput').value = '';
            document.getElementById('processFilter').value = '';
            document.getElementById('statusFilter').value = '';
            filterLogs();
        });

        document.getElementById('refreshLogs').addEventListener('click', function() {
            // Simulate refresh - in real app, this would fetch new data
            currentPage = 1;
            renderLogs();
        });

        document.getElementById('prevPage').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                renderLogs();
            }
        });

        document.getElementById('nextPage').addEventListener('click', function() {
            const totalPages = Math.ceil(filteredLogs.length / logsPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderLogs();
            }
        });

        // Initialize
        createMatrixRain();
        renderLogs();

        // Handle window resize
        window.addEventListener('resize', function() {
            const canvas = document.querySelector('#matrixBg canvas');
            if (canvas) {
                canvas.remove();
                createMatrixRain();
            }
        });
    </script>
</body>
</html>
