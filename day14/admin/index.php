<?php
session_start();
require_once "../models/DbHelper.php";
$db = new DbHelper();
$title = "Admin Dashboard";

// Fetch all users
$fetchData = $db->fetchData_user();

if (isset($_SESSION['accountId'])) {
    $admin = $db->getAllRecords('admin', ['accountId' => $_SESSION['accountId']]);
} else {
    header("Location: login.php");
    exit();
}

ob_start();
include "../viewer/topnav_admin.php";
$navbar = ob_get_clean();

ob_start();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="../assets/css/admin_table.css">

<div class="container">
    <div class="header-section">
        <h1>All Users</h1>
        <div class="search-add">
            <div class="search-box">
                <input type="text" id="userSearch" placeholder="Search users...">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>

    <?php if (!empty($fetchData)) : ?>
        <div class="table-responsive">
            <table class="user-table" aria-label="Users Table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($fetchData as $user) : ?>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">
                                        <?= strtoupper(substr($user['fname'], 0, 1)) . strtoupper(substr($user['lname'], 0, 1)) ?>
                                    </div>
                                    <div>
                                        <div class="user-name"><?= htmlspecialchars($user['fname'] . ' ' . $user['lname']) ?></div>
                                        <div class="user-id">ID: <?= htmlspecialchars($user['userId']) ?></div>
                                    </div>
                                </div>
                            </td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['contactNo']) ?></td>
                            <td>
                                <span class="status-badge active">Active</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-view" data-user-id="<?= $user['userId'] ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="todolistView.php?id=<?= $user['userId'] ?>" class="btn-todolist" title="View Todo List">
                                        <i class="fas fa-tasks"></i>
                                    </a>
                                    <a href="todoList.php?id=<?= $user['userId'] ?>" class="btn-add-task" title="Add Task">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                    <a href="update.php?id=<?= $user['userId'] ?>" class="btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn-delete" onclick="confirmDelete(<?= $user['accountId'] ?>)" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="no-users">
            <i class="fas fa-users-slash"></i>
            <p>No users found.</p>
        </div>
    <?php endif; ?>
</div>

<!-- User Details Modal -->
<div id="userModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">User Details</h3>
            <button class="close-modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="user-modal-avatar">
                <span id="modal-avatar">JD</span>
            </div>
            <div class="user-details-grid">
                <div class="detail-item">
                    <span class="detail-label">Full Name:</span>
                    <span class="detail-value" id="modal-name"></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value" id="modal-email"></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Contact:</span>
                    <span class="detail-value" id="modal-contact"></span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">User ID:</span>
                    <span class="detail-value" id="modal-userid"></span>
                </div>
                <div class="detail-item full-width">
                    <span class="detail-label">Address:</span>
                    <span class="detail-value" id="modal-address"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-modal btn-modal-secondary close-modal">Close</button>
            <button class="btn-modal btn-modal-primary">Send Message</button>
        </div>
    </div>
</div>

<script>
// Modal functionality
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('userModal');
    const closeButtons = document.querySelectorAll('.close-modal');
    
    function openModal(userData) {
        // Set avatar initials
        document.getElementById('modal-avatar').textContent = 
            userData.fname.charAt(0).toUpperCase() + userData.lname.charAt(0).toUpperCase();
        
        // Set user details
        document.getElementById('modal-name').textContent = userData.fname + ' ' + userData.lname;
        document.getElementById('modal-email').textContent = userData.email;
        document.getElementById('modal-contact').textContent = userData.contactNo;
        document.getElementById('modal-userid').textContent = userData.userId;
        document.getElementById('modal-address').textContent = userData.address;
        
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal() {
        modal.classList.remove('show');
        document.body.style.overflow = '';
    }
    
    // Add click event to all view buttons
    document.querySelectorAll('.btn-view').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const userRow = this.closest('tr');
            
            const userData = {
                userId: userId,
                fname: userRow.querySelector('.user-name').textContent.split(' ')[0],
                lname: userRow.querySelector('.user-name').textContent.split(' ')[1],
                email: userRow.cells[1].textContent,
                contactNo: userRow.cells[2].textContent,
                address: '<?= htmlspecialchars($user['address']) ?>' // You might need to adjust this
            };
            
            openModal(userData);
        });
    });
    
    // Close modal events
    closeButtons.forEach(button => {
        button.addEventListener('click', closeModal);
    });
    
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('show')) {
            closeModal();
        }
    });
    
    // Search functionality
    document.getElementById('userSearch').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('.user-table tbody tr');
        
        rows.forEach(row => {
            const name = row.cells[0].textContent.toLowerCase();
            const email = row.cells[1].textContent.toLowerCase();
            const contact = row.cells[2].textContent.toLowerCase();
            
            if (name.includes(searchValue) || email.includes(searchValue) || contact.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});

// Delete confirmation
function confirmDelete(accountId) {
    if (confirm('Are you sure you want to delete this user?')) {
        window.location.href = `../controller/delete_user.php?id=${accountId}`;
    }
}
</script>

<?php
$content = ob_get_clean();
require_once "../viewer/layout.php";
?>