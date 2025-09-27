// Expert Job Finder Dashboard JavaScript

let performanceChart = null;

// Initialize dashboard when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadDashboardStats();
    loadRecentApplications();
    loadPerformanceChart();
    loadSystemHealth();
    
    // Refresh data every 30 seconds
    setInterval(function() {
        loadDashboardStats();
        loadRecentApplications();
    }, 30000);
});

// Load dashboard statistics
async function loadDashboardStats() {
    try {
        const response = await fetch('/api/dashboard/stats');
        const data = await response.json();
        
        // Update stat cards
        document.getElementById('total-applications').textContent = data.total_applications || 0;
        document.getElementById('applied-count').textContent = data.applied || 0;
        document.getElementById('pending-count').textContent = data.pending || 0;
        document.getElementById('failed-count').textContent = data.failed || 0;
        document.getElementById('today-applications').textContent = data.today_applications || 0;
        document.getElementById('apps-per-hour').textContent = data.applications_per_hour || 0;
        document.getElementById('max-daily').textContent = data.max_daily_applications || 0;
        
        // Update site stats
        updateSiteStats(data.site_stats || {});
        
    } catch (error) {
        console.error('Error loading dashboard stats:', error);
        showAlert('Error loading dashboard statistics', 'danger');
    }
}

// Update site statistics
function updateSiteStats(siteStats) {
    const siteStatsContainer = document.getElementById('site-stats');
    const sites = [
        { name: 'LinkedIn', key: 'linkedin', color: '#0077b5' },
        { name: 'Indeed', key: 'indeed', color: '#2557a7' },
        { name: 'Jobberman', key: 'jobberman', color: '#ff6b35' },
        { name: 'MyJobMag', key: 'myjobmag', color: '#28a745' },
        { name: 'Greenhouse', key: 'greenhouse', color: '#00b894' }
    ];
    
    siteStatsContainer.innerHTML = sites.map(site => `
        <div class="col-md-2 col-sm-4 col-6">
            <div class="site-stat">
                <h6>${site.name}</h6>
                <div class="count" style="color: ${site.color}">
                    ${siteStats[site.key] || 0}
                </div>
            </div>
        </div>
    `).join('');
}

// Load recent applications
async function loadRecentApplications() {
    try {
        const response = await fetch('/api/dashboard/applications?limit=10');
        const data = await response.json();
        
        const tableBody = document.getElementById('applications-table');
        
        if (data.applications && data.applications.length > 0) {
            tableBody.innerHTML = data.applications.map(app => `
                <tr>
                    <td>
                        <strong>${app.job_title || 'N/A'}</strong>
                    </td>
                    <td>${app.company_name || 'N/A'}</td>
                    <td>
                        <span class="badge bg-secondary">${app.job_site || 'N/A'}</span>
                    </td>
                    <td>
                        <span class="status-badge status-${app.application_status}">
                            ${app.application_status || 'N/A'}
                        </span>
                    </td>
                    <td>
                        ${app.applied_at ? new Date(app.applied_at).toLocaleDateString() : 'N/A'}
                    </td>
                    <td>
                        ${app.application_status === 'failed' ? 
                            `<button class="btn btn-sm btn-outline-primary" onclick="retryApplication(${app.id})">
                                <i class="fas fa-redo me-1"></i>Retry
                            </button>` : 
                            `<a href="${app.job_url}" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-external-link-alt me-1"></i>View
                            </a>`
                        }
                    </td>
                </tr>
            `).join('');
        } else {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        <i class="fas fa-inbox me-2"></i>
                        No applications found
                    </td>
                </tr>
            `;
        }
        
    } catch (error) {
        console.error('Error loading applications:', error);
        showAlert('Error loading applications', 'danger');
    }
}

// Load performance chart
async function loadPerformanceChart() {
    try {
        const response = await fetch('/api/dashboard/performance');
        const data = await response.json();
        
        const ctx = document.getElementById('performanceChart').getContext('2d');
        
        if (performanceChart) {
            performanceChart.destroy();
        }
        
        const chartData = data.daily_stats || [];
        const labels = chartData.map(stat => new Date(stat.date).toLocaleDateString());
        const applications = chartData.map(stat => stat.total_applications);
        const successful = chartData.map(stat => stat.successful_applications);
        
        performanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Total Applications',
                        data: applications,
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        tension: 0.4
                    },
                    {
                        label: 'Successful Applications',
                        data: successful,
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
    } catch (error) {
        console.error('Error loading performance chart:', error);
    }
}

// Load system health
async function loadSystemHealth() {
    try {
        const response = await fetch('/api/dashboard/health');
        const data = await response.json();
        
        const healthContainer = document.getElementById('health-status');
        const components = data.components || {};
        
        healthContainer.innerHTML = Object.entries(components).map(([name, status]) => `
            <div class="col-md-3 col-sm-6">
                <div class="health-component ${status === 'connected' || status === 'running' || status === 'active' ? 'healthy' : 'unhealthy'}">
                    <i class="fas fa-${getHealthIcon(name)}"></i>
                    <div>
                        <div class="fw-bold">${name.charAt(0).toUpperCase() + name.slice(1)}</div>
                        <small>${status}</small>
                    </div>
                </div>
            </div>
        `).join('');
        
    } catch (error) {
        console.error('Error loading system health:', error);
    }
}

// Get health icon for component
function getHealthIcon(component) {
    const icons = {
        'database': 'database',
        'redis': 'memory',
        'scrapers': 'spider',
        'scheduler': 'clock'
    };
    return icons[component] || 'circle';
}

// Retry failed application
async function retryApplication(applicationId) {
    try {
        const response = await fetch(`/api/dashboard/retry-application/${applicationId}`, {
            method: 'POST'
        });
        
        if (response.ok) {
            showAlert('Application queued for retry', 'success');
            loadRecentApplications();
        } else {
            showAlert('Failed to retry application', 'danger');
        }
        
    } catch (error) {
        console.error('Error retrying application:', error);
        showAlert('Error retrying application', 'danger');
    }
}

// Refresh applications
function refreshApplications() {
    loadRecentApplications();
    showAlert('Applications refreshed', 'success');
}

// Show alert message
function showAlert(message, type) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alertDiv);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.parentNode.removeChild(alertDiv);
        }
    }, 5000);
}

// Format numbers with commas
function formatNumber(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

// Format date
function formatDate(dateString) {
    return new Date(dateString).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}
