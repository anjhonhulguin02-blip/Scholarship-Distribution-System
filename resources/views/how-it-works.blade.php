<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.public-head', [
        'title' => 'How It Works — Block Scholar (Academic Demonstration)',
        'description' => 'How Block Scholar works: roles, the application-status timeline, and exactly what is and isn\'t recorded on a public blockchain.',
    ])
    <style>
        .timeline { display: flex; flex-wrap: wrap; gap: 0; list-style: none; padding: 0; margin: 2rem 0; }
        .timeline li {
            flex: 1 1 160px;
            text-align: center;
            padding: 1rem 0.5rem;
            position: relative;
        }
        .timeline li .step-circle {
            width: 2.5rem; height: 2.5rem; border-radius: 50%;
            background: #17a2b8; color: #fff; display: flex; align-items: center; justify-content: center;
            margin: 0 auto 0.5rem; font-weight: bold;
        }
        .timeline li.rejected .step-circle { background: #c0392b; }
        .role-table th, .role-table td { vertical-align: top; }
        .chain-table th { width: 220px; }
    </style>
</head>

<body>
    @include('partials.public-nav')

    <div class="container-fluid py-5">
        <div class="container" style="max-width: 900px;">
            <h1 class="mb-3">How It Works</h1>
            <p class="lead text-muted">A walkthrough of the roles, the application lifecycle, and exactly what this
                demo does (and does not) put on a blockchain.</p>

            <h2 id="roles" class="mt-5" style="font-size:1.4rem;">Roles</h2>
            <p class="text-muted">There are two account types in this system. There is <strong>no separate
                administrator role or admin panel</strong> &mdash; each Organization/Provider account manages only
                its own scholarships and applicants.</p>
            <div class="table-responsive">
                <table class="table table-bordered role-table">
                    <thead class="thead-light">
                        <tr><th>Role</th><th>What they can do</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Student</strong></td>
                            <td>Browse the public catalog, create an account, fill out a profile (with a
                                report-card/grade upload), apply to open scholarships with a supporting PDF and a
                                payment address, track application status, and view disbursement notifications.</td>
                        </tr>
                        <tr>
                            <td><strong>Organization / Provider</strong></td>
                            <td>Create an account, list scholarships (amount, slots, requirements, optional
                                deadline), review applicants and their uploaded documents, approve or reject
                                applications, and record disbursement of approved funds.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2 id="timeline" class="mt-5" style="font-size:1.4rem;">Sample Application-Status Timeline</h2>
            <p class="text-muted">This mirrors the actual status values used in the codebase, not a simplified
                marketing version.</p>
            <ol class="timeline">
                <li><div class="step-circle">1</div><strong>Submitted</strong><br><span class="text-muted small">Application status: <code>active</code></span></li>
                <li><div class="step-circle">2</div><strong>Under Review</strong><br><span class="text-muted small">Provider reviews uploaded documents</span></li>
                <li><div class="step-circle">3</div><strong>Approved</strong><br><span class="text-muted small">Application status: <code>approved</code><br>Transaction status: <code>waiting for disbursement</code></span></li>
                <li><div class="step-circle">4</div><strong>Disbursed</strong><br><span class="text-muted small">Transaction status: <code>disbursed</code><br>On-chain transfer + tx hash recorded</span></li>
                <li class="rejected"><div class="step-circle">&times;</div><strong>Rejected</strong><br><span class="text-muted small">Application status: <code>rejected</code> (ends the timeline)</span></li>
            </ol>

            <h2 id="disbursement" class="mt-5" style="font-size:1.4rem;">Blockchain Use &amp; Disbursement, Explained Honestly</h2>
            <p>Earlier versions of this project's marketing copy claimed "encrypted, tamper-proof" blockchain
                recordkeeping and guaranteed transparency. Those claims were not accurate to what the code actually
                does, and have been removed. Here is what is actually implemented:</p>

            <div class="table-responsive">
                <table class="table table-bordered chain-table">
                    <tbody>
                        <tr>
                            <th>Network</th>
                            <td>Ethereum <strong>Sepolia testnet</strong> (via <code>ethers.js</code> v6), not
                                Ethereum mainnet. Test ETH has no real-world monetary value. A live deployment would
                                need a documented decision about which network to use and why.</td>
                        </tr>
                        <tr>
                            <th>What's on-chain</th>
                            <td>Only the fund transfer itself: an amount of test ETH sent from the provider's
                                connected wallet to the student's payment address, via a smart contract call. The
                                resulting transaction hash is stored off-chain for reference and linked to a
                                block explorer.</td>
                        </tr>
                        <tr>
                            <th>What's off-chain</th>
                            <td>Everything else, deliberately: names, addresses, birth dates, uploaded PDFs,
                                report-card images, application text, and notifications all live in the application
                                database, never on the public ledger. A public blockchain is permanent and
                                world-readable, which makes it the wrong place for applicant PII &mdash; this system
                                does not and should not put any of that on-chain.</td>
                        </tr>
                        <tr>
                            <th>Wallet connection</th>
                            <td>The provider's own wallet signs the transaction (no private key is ever stored in
                                the app or sent to the browser). This demo currently targets a configured JSON-RPC
                                endpoint intended for a local test node; a production deployment would need a full
                                wallet-connect flow.</td>
                        </tr>
                        <tr>
                            <th>Known limitation</th>
                            <td>The application currently trusts the transaction hash and amount reported by the
                                browser after a transaction is sent, rather than independently re-checking the
                                transaction receipt against the RPC node before marking a disbursement verified. This
                                is flagged in the codebase (<code>chainVerified</code> column) as a documented gap
                                rather than a claimed guarantee &mdash; see the project's security notes for the
                                planned fix.</td>
                        </tr>
                        <tr>
                            <th>Contract source</th>
                            <td>The deployed contract's ABI is loaded from local config; this demo does not ship a
                                verified block-explorer link because no contract is currently deployed for this
                                academic instance. A real deployment should link the verified contract source on the
                                relevant explorer.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2 id="demo" class="mt-5" style="font-size:1.4rem;">Read-Only Walkthrough</h2>
            <p class="text-muted">
                No account required to see what each dashboard actually contains:
            </p>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="card h-100"><div class="card-body">
                        <h3 style="font-size:1.1rem;">Student Dashboard</h3>
                        <ul class="mb-0">
                            <li>Available scholarships you're eligible to apply for, with open-slot counts</li>
                            <li>Your submitted applications and their current status</li>
                            <li>A profile page for your details, photo, and report-card upload</li>
                            <li>Disbursement notifications once a provider pays out an approved award</li>
                        </ul>
                    </div></div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="card h-100"><div class="card-body">
                        <h3 style="font-size:1.1rem;">Organization/Provider Dashboard</h3>
                        <ul class="mb-0">
                            <li>A form to list a new scholarship, with an optional application deadline</li>
                            <li>Incoming applications with the applicant's uploaded requirement document</li>
                            <li>Approve/reject controls, and a disbursement flow that records a blockchain
                                transaction hash</li>
                            <li>A transaction log showing whether each disbursement was verified on-chain</li>
                        </ul>
                    </div></div>
                </div>
            </div>

            <div class="text-center my-5">
                <a href="/scholarships" class="btn btn-outline-primary btn-lg mr-2">Browse Scholarships</a>
                <a href="/register" class="btn btn-primary btn-lg">Create an Account</a>
            </div>
        </div>
    </div>

    @include('partials.public-footer')

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
