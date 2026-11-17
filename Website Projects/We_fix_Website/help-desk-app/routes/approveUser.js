const express = require('express');
const router = express.Router();
const db = require('../database');

router.put('/approveUser', (req, res) => {// Dexetai put aithma sth diadromh
    const { id, role } = req.body;//Pairnei ta dedomena apo to swma tou aithmatos

    //Enhmerwnei ta dedomena tou xrhsth
    const query = 'UPDATE users SET Approved=1, Role=? WHERE id=?';

    //Ektelesh tou query
    db.query(query, [role, id], (err, results) => {
        if (err) {
            res.status(500).send(err.message);
            return;
        }
        // Stelnei apanthsh JSON sto frontend me mhnyma epityxias kai ta nea stoixeia
        res.json({
            message: 'Το αίτημα εγκρίθηκε με επιτυχία!',
            user: {
                role: role,
                id: id
            }
        });
    });
});

module.exports = router;